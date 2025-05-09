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
        return view('pages.administracion.homeAdmin');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function gestionarUsuario()
    {
        $usuarios = Usuario::with('rol')->get(); // relacionar con el rol
        return view('pages.usuario.gestionUsuario', compact('usuarios'));
    }

    public function agregarUsuarios(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'nombre_usuario' => 'required|string|max:100',
            'correo_usuario' => 'required|email|unique:usuarios,correo_usuario',
            'password_usuario' => 'required|string|min:6',
            'id_rol' => 'required|exists:rols,id_rol',
        ]);

        // Crear el nuevo usuario
        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo_usuario = $request->correo_usuario;
        $usuario->password_usuario = $request->password_usuario; // Se encripta automáticamente en el modelo
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('vista.administrador.home')->with('success', 'Usuario administrador registrado correctamente.');
    }
    public function eliminados()
    {
        $usuariosEliminados = Usuario::onlyTrashed()->with('rol')->get();
        return view('pages.usuario.gestionUsuario', compact('usuariosEliminados'));
    }
    public function usuarioRegister()
    {
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.usuario.agregarUsuario', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $roles = Rol::all(); // Obtener roles para el formulario
        return view('pages.usuario.editar', compact('usuario', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_usuario)
    {
        // Validación
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo_usuario' => 'required|email|unique:usuarios,correo_usuario,' . $id_usuario . ',id_usuario',
            'id_rol' => 'required|exists:rols,id_rol',
        ]);

        // Buscar el usuario por ID
        $usuario = Usuario::findOrFail($id_usuario);

        // Actualizar datos
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo_usuario = $request->correo_usuario;
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('vista.administrador.home')->with('success', 'Usuario actualizado correctamente.');
    }


    /**
     * Elimine al usuario especificado del almacenamiento.
     */
    public function destroy($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->delete(); // Eliminación lógica (SoftDeletes)

        return redirect()->route('vista.administrador.home')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Restaurar un usuario eliminado lógicamente.
     */
    public function restore($id_usuario)
    {
        $usuario = Usuario::withTrashed()->findOrFail($id_usuario);
        $usuario->restore(); // Restaurar el usuario

        return redirect()->route('vista.administrador.home')->with('success', 'Usuario restaurado correctamente.');
    }
}
