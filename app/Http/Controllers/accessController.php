<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function showLogin()
    {
        return view('pages.access.login');
    }

    public function login(Request $request)
    {
        // Validar las credenciales del formulario
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar como usuario (tabla `usuarios`)
        if (Auth::guard('web')->attempt(['correo_usuario' => $credentials['correo'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Verificar el rol del usuario autenticado
            $user = Auth::guard('web')->user();
            if ($user->rol && $user->rol->nombre_rol === 'Administrador') {
                return redirect()->route('vista.administrador.home'); // Redirigir al panel de administración
            }

            return redirect()->intended('/'); // Redirigir a la página principal para otros roles
        }

        // Intentar autenticar como cliente (tabla `clientes`)
        if (Auth::guard('cliente')->attempt(['correo_cliente' => $credentials['correo'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Redirigir al home para clientes
            return redirect()->route('home');
        }

        // Si las credenciales no son válidas, regresar con un error
        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

}
