<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permiso::all(); // Obtener todos los permisos
        return view('pages.gestion.permisos.index', compact('permisos'));
    }

    public function create()
    {
        return view('pages.gestion.permisos.create');
    }
    public function store(Request $request)
    {
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
    public function destroy($id_permiso)
    {
        $permiso = Permiso::findOrFail($id_permiso);
        // Verificar si tiene roles asociados
        if ($permiso->roles()->count() > 0) {
            return redirect()->route('permiso.index')
                ->with('error', 'No se puede eliminar el permiso porque tiene roles asociados.');
        }
        // Eliminar el permiso
        $permiso->delete();

        return redirect()->route('permiso.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
