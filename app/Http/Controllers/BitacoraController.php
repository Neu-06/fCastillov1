<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;


class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        $query = Bitacora::query();

        if ($request->filled('usuario')) {
            $query->where('nombre_usuario', 'like', "%{$request->usuario}%");
        }

        if ($request->filled('tipo')) {
            $query->where('accion', $request->tipo);
        }

        if ($request->filled('fecha')) {
            // Como 'fecha_hora' es string, usamos LIKE
            $query->where('fecha_hora', 'like', "%{$request->fecha}%");
        }

        $bitacoras = $query->orderByDesc('id_bitacora')->paginate(20);

        return view('pages.gestion.bitacoras.index', compact('bitacoras'));
        }

    
        public static function registrar($accion, $descripcion)
        {
            $usuario = Auth::user();
            $ip = request()->ip();
            $fecha = now()->timezone('America/La_Paz')->format('d/m/Y H:i:s');

            // Si quieres registrar solo si hay usuario, usa esto:
            if ($usuario == null) return;

            // Registro en la tabla bitácora
            Bitacora::create([
                'accion' => $accion,
                'descripcion' => $descripcion,
                'nombre_usuario' => $usuario?->nombre_usuario ?? 'Sistema',
                'ip_origen' => $ip,
                'fecha_hora' => $fecha,
                'id_usuario' => $usuario?->id_usuario
            ]);
        }
}
