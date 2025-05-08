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
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
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
                return redirect()->route('vista.administrador.home');
                // return redirect()->route('vista.vendedor.home');
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
