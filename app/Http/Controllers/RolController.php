<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.Rol.homeRol', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Rol.rolCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'nombre' => 'required|string|max:255|unique:rols,nombre',
    ]);

    $rol =Rol::create([
        'nombre' => $request->nombre,
    ]);

    //return redirect()->route('vista.administrador.home')->with('success', 'Rol registrado correctamente.');
    return redirect()->route('rol.index')->with('success', 'Permisos del rol ' . $rol->nombre . ' actualizados correctamente.');


    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return redirect('/admin/roles')->with('success', 'Rol eliminado correctamente.');
    }

    // Muestra el formulario para asignar permisos al rol
public function editarPermisos($id)
{
    $rol = Rol::findOrFail($id);
    $permisos = Permiso::all();

    return view('pages.Permisos.editar_permisos', compact('rol', 'permisos'));
}

// Procesa el formulario para actualizar permisos del rol
public function actualizarPermisos(Request $request, $id)
{
    $rol = Rol::findOrFail($id);
    $rol->permisos()->sync($request->input('permisos', [])); // sincroniza la tabla rol_permiso

    // Bitácora (opcional)
    /*
    Bitacora::create([
        'accion' => 'Actualizó permisos del rol: ' . $rol->nombre,
        'fecha' => now(),
        'usuario_id' => Auth::user()->ci,
    ]);
    */

    // return redirect()->route('rol.permisos.editar', $rol->id)
    // ->with('success', 'Permisos actualizados correctamente.');
    return redirect()->route('rol.index')
    ->with('success', 'Permisos del rol "' . $rol->nombre . '" actualizados correctamente.');
}

}
