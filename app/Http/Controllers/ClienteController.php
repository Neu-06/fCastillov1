<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function clienteRegister()
    {
        return view('pages.access.agregarCliente');
    }
    /**
     * Store a newly created resource in storage.
     * este metodo toma los datos de un nuevo cliente para el registro
     */
    public function store(Request $request)
{
    // Verifica si los datos que se están enviando son correctos
    //dd($request->all());

    $validated = $request->validate([
        'ci'          => 'required|unique:clientes,ci',
        'nombre'      => 'required|string|max:100',
        'correo'      => 'required|email|unique:clientes,correo',
        'contrasena'  => 'required|string|min:5',
        'telefono'    => 'nullable|string|max:20',
        'direccion'   => 'nullable|string|max:255',
    ]);

    //dd($validated); // Esto te permitirá ver los datos validados

    // Si la validación pasa, los datos serán insertados
    Cliente::create([
        'ci'         => $request->ci,
        'nombre'     => $request->nombre,
        'correo'     => $request->correo,
        'contrasena' => bcrypt($request->contrasena),
        'telefono'   => $request->telefono,
        'direccion'  => $request->direccion,
        'estado'     => true,
    ]);

    return redirect()->route('login')->with('success', 'Cliente registrado exitosamente. Inicia sesión.');
}
    /**
     * Display the specified resource.
     */
    public function gestionarCliente(Cliente $cliente)
    {
        $estado = request()->query('estado', 'activo'); // por defecto es 'activo'

        $clientes = Cliente::where('estado', $estado === 'activo')
                ->get();

    return view('pages.access.gestionarCliente', compact('clientes', 'estado'));
    }
    public function show(Cliente $cliente)
    {
        //
    }

    public function agregarClientes(Request $request)   
    {
    // Validación de los campos del formulario
    $request->validate([
        'ci' => 'required|string|unique:clientes,ci',
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|unique:clientes,correo',
        'contrasena' => 'required|string|min:6',
        'direccion' => 'required|string',
        'telefono' => 'required|int|min:6',
    ]);
    // Crear el nuevo cliente
    $cliente = new Cliente();
    $cliente->ci = $request->ci;
    $cliente->nombre = $request->nombre;
    $cliente->correo = $request->correo;
    $cliente->contrasena = Hash::make($request->contrasena); // encriptar la contraseña
    $cliente->telefono = $request->telefono;
    $cliente->direccion = $request->direccion;
    $cliente->save();

    return redirect()->route('administrador.gestionarCliente')->with('success', 'Cliente registrado correctamente.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ci)
    {
       $cliente = Cliente::findOrFail($ci);
      return view('pages.access.editCliente', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ci)
    {
        // Validación
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email|unique:clientes,correo,' . $ci . ',ci',
                'estado' => 'required|boolean',
                'telefono' => 'required|string',
                'direccion' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // <-- Esto te muestra un array con los errores por campo
        }
    //$request->validate([
     //   'nombre' => 'required|string|max:255',
     //   'correo' => 'required|email|unique:clientes,correo,' . $ci . ',ci',
     //   'estado' => 'required|boolean',
     //   'telefono' => 'required|numeric',
     //   'direccion' => 'required|string',
    //]);
    //dd($request->all());
    // Buscar el usuario por CI
    $cliente = Cliente::findOrFail($ci);

    // Actualizar datos
    $cliente->nombre = $request->nombre;
    $cliente->correo = $request->correo;
    $cliente->estado = $request->estado;
    $cliente->telefono = $request->telefono;
    $cliente->direccion = $request->direccion;
    $cliente->save();

    return redirect()->route('administrador.gestionarCliente')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ci)
    {
        $Cliente = Cliente::findOrFail($ci);
        $Cliente->estado = false; // Asigna false al atributo estado
        $Cliente->save();         // Guarda los cambios en la base de datos

        return redirect()->route('administrador.gestionarCliente')->with('success', 'Cliente eliminado correctamente.');
    }

    public function login(Request $request)
{
    // 1. Validar datos de entrada
    $request->validate([
        'correo' => 'required',
        'contrasena' => 'required',
    ]);
    // Buscar en la tabla de usuarios (admin o vendedor)
    $usuario = Usuario::where('correo', $request->correo)->first();
    
    if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
        // Verificar si tiene rol asignado
        if (!$usuario->rol) {
            return redirect()->route('login')->with('error', 'El usuario no tiene un rol asignado.');
        }
        Auth::login($usuario);
        // Redirigir según el rol
        switch ($usuario->rol->nombre) {
            case 'Administrador':
                return redirect()->route('vista.administrador.home');
            case 'Vendedor':
                return redirect()->route('vista.vendedor.home');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Rol no válido.');
        }
    }

    // Si no está en usuarios, buscar en clientes
    $cliente = Cliente::where('correo', $request->correo)->first();

    if ($cliente && Hash::check($request->contrasena, $cliente->contrasena)) {
        Auth::login($cliente); // Esto requiere que Cliente implemente la interfaz Auth

        return redirect()->route('home');
    }

    return back()->with('error', 'Correo o contraseña incorrectos.');
}

}
