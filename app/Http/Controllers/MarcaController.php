<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('pages.gestion.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.gestion.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_marca' => 'required|string|max:100|unique:marcas,nombre_marca',
        ]);

        Marca::create([
            'nombre_marca' => $request->nombre_marca,
        ]);

        return redirect()->route('marca.index')->with('success', 'Marca creada correctamente.');
    }

    public function destroy($id_marca)
    {
        $marcas = Marca::findOrFail($id_marca);


        if ($marcas->detalleProductos()->count() > 0) {
            return redirect()->route('marca.index')
                ->with('error', 'No se puede eliminar la Marca porque tiene productos asociados.');
        }

        $marcas->delete();

        return redirect()->route('marca.index')->with('success', 'Marca eliminada correctamente.');
    }
}
