<?php

namespace App\Helpers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class BitacoraHelper
{
    public static function registrar($accion, $descripcion)
    {
        // Evitar bitácora durante migraciones o pruebas
        if (app()->runningInConsole() || app()->runningUnitTests()) {
            return;
        }

        $usuario = Auth::user();
        $ip = request()->ip();
        $fecha = now()->format('d/m/Y H:i'); // precisión por minuto

        // Evita duplicado exacto dentro del mismo minuto
        $yaExiste = Bitacora::where('accion', $accion)
            ->where('descripcion', $descripcion)
            ->where('nombre_usuario', $usuario?->nombre_usuario ?? 'Sistema')
            ->where('ip_origen', $ip)
            ->where('fecha_hora', $fecha)
            ->exists();

        if ($yaExiste) return;

        // Registro en la tabla bitácora
        Bitacora::withoutEvents(function () use ($accion, $descripcion, $usuario, $ip, $fecha) {
            Bitacora::create([
                'accion' => $accion,
                'descripcion' => $descripcion,
                'nombre_usuario' => $usuario?->nombre_usuario ?? 'Sistema',
                'ip_origen' => $ip,
                'fecha_hora' => $fecha,
                'id_usuario' => $usuario?->id_usuario
            ]);
        });
    }
}
