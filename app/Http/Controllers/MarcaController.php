<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Marca;
use Illuminate\Http\Request;
use app\Http\Controllers\BitacoraController;

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

        BitacoraController::registrar(
            'CREAR',
            'Se creó la marca: ' . $request->nombre_marca
        );

        return redirect()->route('marca.index')->with('success', 'Marca creada correctamente.');
    }

    public function destroy($id_marca)
    {
        $marcas = Marca::findOrFail($id_marca);

        if ($marcas->Productos()->count() > 0) {
            return redirect()->route('marca.index')
                ->with('error', 'No se puede eliminar la Marca porque tiene productos asociados.');
        }
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó la marca: ' . $marcas->nombre_marca
        );
        $marcas->delete();

        return redirect()->route('marca.index')->with('success', 'Marca eliminada correctamente.');
    }
}
