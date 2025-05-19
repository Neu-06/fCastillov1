<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Listar proveedores
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('pages.gestion.proveedores.index', [
            'proveedores' => $proveedores,
            'eliminados' => false
        ]);
    }

    // Mostrar formulario para crear proveedor
    public function create()
    {
        return view('pages.gestion.proveedores.create');
    }

    // Guardar proveedor nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombreC_proveedor' => 'required|string|max:100',
            'correo_proveedor' => 'required|email|unique:proveedores,correo_proveedor',
            'telefono_proveedor' => 'required|string|max:20',
            'direccion_proveedor' => 'required|string|max:255',
        ]);

        Proveedor::create($request->only([
            'nombreC_proveedor',
            'correo_proveedor',
            'telefono_proveedor',
            'direccion_proveedor',
        ]));

        return redirect()->route('proveedor.index')->with('success', 'Proveedor registrado correctamente.');
    }

    // Mostrar formulario para editar proveedor
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('pages.gestion.proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreC_proveedor' => 'required|string|max:100',
            'correo_proveedor' => 'required|email|unique:proveedores,correo_proveedor,' . $id . ',id_proveedor',
            'telefono_proveedor' => 'required|string|max:20',
            'direccion_proveedor' => 'required|string|max:255',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->only([
            'nombreC_proveedor',
            'correo_proveedor',
            'telefono_proveedor',
            'direccion_proveedor',
        ]));

        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar proveedor (SoftDelete)
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('proveedor.index')->with('success', 'Proveedor eliminado correctamente.');
    }

    // Listar proveedores eliminados (SoftDeletes)
    public function eliminados()
    {
        $proveedores = Proveedor::onlyTrashed()->get();
        return view('pages.gestion.proveedores.index', [
            'proveedores' => $proveedores,
            'eliminados' => true
        ]);
    }

    // Restaurar proveedor eliminado
    public function restore($id)
    {
        $proveedor = Proveedor::withTrashed()->findOrFail($id);
        $proveedor->restore();

        return redirect()->route('proveedor.index')->with('success', 'Proveedor restaurado correctamente.');
    }
}
