<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    //vista principal de gestión de usuarios
    public function index()
    {   
        $this->authorize('viewAny', Usuario::class); // Solo si tiene permiso 'Ver Usuarios'
        $usuarios = Usuario::with('rol')->get(); // relacionar con el rol
        return view('pages.gestion.usuarios.index', [
            'usuarios' => $usuarios,
            'eliminados' => false
        ]);
    }

    //vista formulario de registro de usuario
    public function create()
    {   $this->authorize('create', Usuario::class); // Solo si tiene permiso 'Agregar Usuarios'
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.gestion.usuarios.create', compact('roles'));
    }
    //guarda usuario nuevo
    public function store(Request $request)
    {   $this->authorize('create', Usuario::class); // Protección también desde el backend
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
        $usuario->password_usuario = $request->password_usuario; //Se encripta automáticamente en el modelo
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario administrador registrado correctamente.');
    }



    public function eliminados()
    {   $this->authorize('viewAny', Usuario::class); // Protege ver eliminados también
        $usuarios = Usuario::onlyTrashed()->with('rol')->get();
        return view('pages.gestion.usuarios.index', [
            'usuarios' => $usuarios,
            'eliminados' => true
        ]);
    }

    /**
     * Muestra el formulario para editar el usuario especificado.
     */
    public function edit($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
         $this->authorize('update', $usuario); // Solo si tiene permiso 'Editar Usuarios'
        $roles = Rol::all(); // Obtener roles para el formulario
        return view('pages.gestion.usuarios.edit', compact('usuario', 'roles'));
    }


    /**
     * Actualiza el usuario especificado en la base de datos.
     */
    public function update(Request $request, $id_usuario)
    {
        // Buscar el usuario por ID
        $usuario = Usuario::findOrFail($id_usuario);
        $this->authorize('update', $usuario); // Protección en update
        // Validación
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo_usuario' => 'required|email|unique:usuarios,correo_usuario,' . $id_usuario . ',id_usuario',
            'id_rol' => 'required|exists:rols,id_rol',
        ]);



        // Actualizar datos
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo_usuario = $request->correo_usuario;
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
    }


    /**
     * Elimine al usuario especificado del sistema.
     */
    public function destroy($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $this->authorize('delete', $usuario); // Solo si tiene permiso 'Eliminar Usuarios'
        $usuario->delete(); // Eliminación lógica (SoftDeletes)

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Restaurar un usuario eliminado lógicamente.
     */
    public function restore($id_usuario)
    {
        $usuario = Usuario::withTrashed()->findOrFail($id_usuario);
        $this->authorize('restore', $usuario); // Solo si tiene permiso para restaurar
        $usuario->restore(); // Restaurar el usuario

        return redirect()->route('usuario.index')->with('success', 'Usuario restaurado correctamente.');
    }


    // cerrar seccion usuario 
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
