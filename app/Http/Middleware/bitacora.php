<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class BitacoraMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Registro de la solicitud en la bitácora
        Bitacora::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'accion' => 'Solicitud realizada a ' . $request->path(),
            'fecha_hora' => now(),
            'id_operacion' => null,
        ]);

        return $response;
    }
}