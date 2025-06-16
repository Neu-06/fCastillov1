<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\BitacoraController;

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
        BitacoraController::registrar(
            'CREAR',
            'Se registró un nuevo permiso: ' . $request->nombre_permiso
        );
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

        // Verificar si tiene roles asociados
        if ($permiso->roles()->count() > 0) {
            return redirect()->route('permiso.index')
                ->with('error', 'No se puede eliminar el permiso porque tiene roles asociados.');
        }
        // Eliminar el permiso

        $permiso->delete();
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó el permiso: ' . $permiso->nombre_permiso
        );

        return redirect()->route('permiso.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
