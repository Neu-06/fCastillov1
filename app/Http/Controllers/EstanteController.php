<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\BitacoraController;

class EstanteController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Area::class);
        $estantes = Estante::paginate(10);
        return view('pages.gestion.estantes.index', compact('estantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        return view('pages.gestion.estantes.create', ['Areas' => $areas]);
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

                // Registrar en bitácora
        BitacoraController::registrar(
            'CREAR',
            'Se creó el estante: ' . $request->nombre_estante
        );


        return redirect()->route('estante.index')->with('success', 'Estante creado correctamente.');
    }

    public function destroy($id_estante)
    {

        $estantes = Estante::findOrFail($id_estante);
        $estantes->delete();
        // Registrar en bitácora
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó el estante: ' . $estantes->nombre_estante
        );
        return redirect()->route('estante.index')->with('success', 'Estante eliminado correctamente.');
    }
}
