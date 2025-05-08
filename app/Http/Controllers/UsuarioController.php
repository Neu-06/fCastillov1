<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.usuario.home');
    }
    public function homeVendedor()
    {
        return view('pages.usuario.home');
    }
    public function homeAdmin()
    {
        return view('pages.usuario.homeAdm');
    }
    /**
     * Show the form for creating a new resource.
     */

     public function gestionarUsuario()
    {
        $estado = request()->query('estado', 'activo'); // por defecto es 'activo'

    $usuarios = Usuario::with('rol')
                ->where('estado', $estado === 'activo')
                ->get();

    return view('pages.usuario.gestionUsuario', compact('usuarios', 'estado'));
    }
    public function agregarUsuarios(Request $request)   
    {
    // Validación de los campos del formulario
    $request->validate([
        'ci' => 'required|string|unique:usuarios,ci',
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|unique:usuarios,correo',
        'contrasena' => 'required|string|min:6',
        'id_rol' => 'required|exists:rols,id',
    ]);
    // Crear el nuevo usuario
    $usuario = new Usuario();
    $usuario->ci = $request->ci;
    $usuario->nombre = $request->nombre;
    $usuario->correo = $request->correo;
    $usuario->contrasena = Hash::make($request->contrasena); // encriptar la contraseña
    $usuario->id_rol = $request->id_rol;
    $usuario->save();

    return redirect()->route('administrador.gestionarUsuario')->with('success', 'Usuario administrador registrado correctamente.');
    }

    public function usuarioRegister()
    {
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.usuario.agregarUsuario', compact('roles'));
    }
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ci)
    {
       $usuario = Usuario::findOrFail($ci);
         $roles = Rol::all(); // Para el select si quieres cambiar rol
      return view('pages.usuario.editar', compact('usuario', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ci)
    {
        // Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|email|unique:usuarios,correo,' . $ci . ',ci',
        'estado' => 'required|string',
        'id_rol' => 'required|exists:rols,id',
    ]);

    // Buscar el usuario por CI
    $usuario = Usuario::findOrFail($ci);

    // Actualizar datos
    $usuario->nombre = $request->nombre;
    $usuario->correo = $request->correo;
    $usuario->estado = $request->estado;
    $usuario->id_rol = $request->id_rol;
    $usuario->save();

    return redirect()->route('administrador.gestionarUsuario')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ci)
    {
        $usuario = Usuario::findOrFail($ci);
        $usuario->estado = false; // Asigna false al atributo estado
        $usuario->save();         // Guarda los cambios en la base de datos

        return redirect()->route('administrador.gestionarUsuario')->with('success', 'Usuario eliminado correctamente.');
    }
}
