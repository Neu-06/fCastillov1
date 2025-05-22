<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.gestion.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.gestion.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:rols,nombre_rol',
        ]);

        // Crear el nuevo rol
        Rol::create([
            'nombre_rol' => $request->nombre_rol,
        ]);

        return redirect()->route('rol.index')->with('success', 'Rol registrado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rol)
    {
        $rol = Rol::findOrFail($id_rol);

        // Verificar si tiene usuarios asociados
        if ($rol->usuarios()->count() > 0) {
            return redirect()->route('rol.index')
                ->with('error', 'No se puede eliminar el rol porque tiene usuarios asociados.');
        }

        $rol->delete();

        return redirect()->route('rol.index')->with('success', 'Rol eliminado correctamente.');
    }
}
