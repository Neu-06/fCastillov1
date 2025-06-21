<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Area;
use Illuminate\Http\Request;

class EstanteController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Area::class);
        $Estantes = Estante::all();
        return view('pages.gestion.estante.index', compact('Estantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Areas = Area::all();
        return view('pages.gestion.estante.create', ['Areas' => $Areas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Area::class);
        $request->validate([
            'nombre_estante' => 'required|string|max:100|unique:estantes,nombre_estante',
             'id_area' => 'required|exists:areas,id_area',
        ]);
       // dd($request->all());
        Estante::create([
            'nombre_estante' => $request->nombre_estante,
             'id_area' => $request->id_area,
        ]);

        return redirect()->route('estante.index')->with('success', 'Estante creado correctamente.');
    }

    public function destroy($id_estante)
    {

        $Estantes = Estante::findOrFail($id_estante);
        $Estantes->delete();

        return redirect()->route('estante.index')->with('success', 'Estante eliminado correctamente.');
    }
}
