<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\BitacoraController;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$this->authorize('viewAny', Area::class);
        $Areas = Area::paginate(10);
        return view('pages.gestion.Area.index', compact('Areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Area::class);
        return view('pages.gestion.Area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Area::class);
        $request->validate([
            'nombre_area' => 'required|string|max:100|unique:areas,nombre_area',
        ]);

        Area::create([
            'nombre_area' => $request->nombre_area,
        ]);

            BitacoraController::registrar(
            'CREAR',
            'Se creó el área: ' . $request->nombre_area
            );

        return redirect()->route('area.index')->with('success', 'Area creada correctamente.');
    }

    public function destroy($id_area)
    {

        $Areas = Area::findOrFail($id_area);
        $nombre = $Areas->nombre_area;
        $Areas->delete();
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó el área: ' . $nombre
        );
        return redirect()->route('area.index')->with('success', 'Area eliminada correctamente.');
    }
}
