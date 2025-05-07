<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('pages.proveedor.index', compact('proveedores'));
    }
    //2.Mostrar formulario para crear nuevo proveedor
    public function create()
    {
        return view('pages.proveedor.create');
    }
    // 3. Guardar proveedor en la base de datos
    public function store(Request $request)
    {
        // Validación (opcional, pero recomendable)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:proveedor,telefono',
            'email' => 'nullable|email|max:100|unique:proveedor,email',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear proveedor
        Proveedor::create($request->all());

        return redirect()->route('proveedor.index')->with('success', 'Proveedor creado correctamente');
    }
        // 4. Mostrar formulario de edición
    // 4. Mostrar formulario de edición
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('pages.proveedor.edit', compact('proveedor'));
    }
    // 5. Actualizar proveedor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:proveedor,telefono,' . $id . ',id_proveedor',
            'email' => 'nullable|email|max:100|unique:proveedor,email,' . $id . ',id_proveedor',
            'direccion' => 'nullable|string|max:255',
        ]);
    
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
    
        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado correctamente');
    }
    // 6. Eliminar proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
    
        return redirect()->route('proveedor.index')->with('success', 'Proveedor eliminado correctamente');
    }
    // 7. Mostrar detalle (opcional)
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('pages.proveedor.show', compact('proveedor'));
    }
}
