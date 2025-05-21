<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function showLogin()
    {
        $isCliente = Auth::guard('cliente')->check();
        $isUsuario = Auth::guard('web')->check();
        return view('pages.access.login', compact('isCliente', 'isUsuario'));
    }

    public function login(Request $request)
    {
        // Validar las credenciales del formulario
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar como usuario (guard web, provider usuarios)
        if (Auth::guard('web')->attempt([
            'correo_usuario' => $credentials['correo'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();
            if ($user->rol && $user->rol->nombre_rol === 'Administrador') {
                return redirect()->route('admin.home');
            }
            // Si es usuario pero no administrador, redirigir al home general
            return redirect()->route('index');
        }

        // Intentar autenticar como cliente (guard cliente, provider clientes)
        if (Auth::guard('cliente')->attempt([
            'correo_cliente' => $credentials['correo'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            // Redirigir al home del e-commerce para clientes
            return redirect()->route('index');
        }

        // Si las credenciales no son válidas, regresar con un error
        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }
}
