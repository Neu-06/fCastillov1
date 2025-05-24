<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    /**
     * Muestra el formulario de login para usuarios o clientes.
     */
    public function showLogin()
    {
        $isCliente = Auth::guard('cliente')->check();
        $isUsuario = Auth::guard('web')->check();
        return view('pages.access.login', compact('isCliente', 'isUsuario'));
    }

    /**
     * Maneja la lógica de autenticación para usuarios del sistema y clientes.
     */    
    public function login(Request $request)
    {
        // Validar las credenciales del formulario
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // 👤 Autenticación para usuarios del sistema (administrador, vendedor, etc.)
        if (Auth::guard('web')->attempt([
            'correo_usuario' => $credentials['correo'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate(); // Reforzar seguridad

            // Redirigir al dashboard general del sistema
            return redirect()->route('admin.home');
        }

        // 🛒 Autenticación para clientes del e-commerce
        if (Auth::guard('cliente')->attempt([
            'correo_cliente' => $credentials['correo'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            // Redirigir al home de clientes
            return redirect()->route('index');
        }

        // Si las credenciales no son válidas, regresar con un error
        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }
}
