<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Lista todos los permisos.
     * Requiere permiso: "Ver Permisos"
     */
    public function index()
    {
        $this->authorize('viewAny', Permiso::class);
        $permisos = Permiso::all(); // Obtener todos los permisos
        return view('pages.gestion.permisos.index', compact('permisos'));
    }

    /**
     * Muestra el formulario para crear un nuevo permiso.
     * Requiere permiso: "Agregar Permisos"
     */    
    public function create()
    {  
        $this->authorize('create', Permiso::class);
        return view('pages.gestion.permisos.create');
    }

    /**
     * Guarda un nuevo permiso en la base de datos.
     * Requiere permiso: "Agregar Permisos"
     */    
    public function store(Request $request)
    {
        $this->authorize('create', Permiso::class);
        // Validación de los datos
        $request->validate([
            'nombre_permiso' => 'required|string|max:50|unique:permisos,nombre_permiso',
        ]);

        // Crear el nuevo permiso
        Permiso::create([
            'nombre_permiso' => $request->nombre_permiso,
        ]);

        return redirect()->route('permiso.index')->with('success', 'Permiso registrado correctamente.');
    }
    /*
     * Elimina un permiso.
     * Requiere permiso: "Eliminar Permisos"
     */    
    public function destroy($id_permiso)
    {
        $permiso = Permiso::findOrFail($id_permiso);
        $this->authorize('delete', $permiso);
        $permiso->delete();

        return redirect()->route('permiso.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
