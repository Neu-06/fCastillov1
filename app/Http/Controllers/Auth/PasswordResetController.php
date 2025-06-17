<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Usuario;
use App\Models\Cliente;

class PasswordResetController extends Controller
{
    // Mostrar formulario para solicitar enlace
    public function showLinkRequestForm()
    {
        return view('pages.access.resetPassword');
    }

    // Enviar enlace de restablecimiento 
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Buscar en usuarios
        $usuario = Usuario::where('correo_usuario', $request->email)->first();
        if ($usuario) {
            $status = Password::broker('usuarios')->sendResetLink(['correo_usuario' => $request->email]);
            return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
        }

        // Buscar en clientes
        $cliente = Cliente::where('correo_cliente', $request->email)->first();
        if ($cliente) {
            $status = Password::broker('clientes')->sendResetLink(['correo_cliente' => $request->email]);
            return $status === Password::RESET_LINK_SENT
                ? back()->with('status', 'Se envió correctamente el enlace de restablecimiento al correo ingresado.')
                : back()->withErrors(['email' => __($status)]);
        }

        // Si no existe en ninguno
        return back()->withErrors(['email' => 'No existe usuario, revise su correo.']);
    }

    // Mostrar formulario para nueva contraseña 
    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->input('email');
        return view('pages.access.newPassword', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    // Actualizar contraseña 
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Buscar en usuarios
        $usuario = Usuario::where('correo_usuario', $request->email)->first();
        if ($usuario) {
            $status = Password::broker('usuarios')->reset(
                [
                    'correo_usuario' => $request->email,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                    'token' => $request->token,
                ],
                function ($user, $password) {
                    $user->password_usuario = $password;
                    $user->save();
                }
            );
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        }

        // Buscar en clientes
        $cliente = Cliente::where('correo_cliente', $request->email)->first();
        if ($cliente) {
            $status = Password::broker('clientes')->reset(
                [
                    'correo_cliente' => $request->email,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                    'token' => $request->token,
                ],
                function ($user, $password) {
                    $user->password_cliente = $password;
                    $user->save();
                }
            );
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        }

        // Si no existe en ninguno
        return back()->withErrors(['email' => 'No se encontró ningún usuario o cliente con ese correo.']);
    }
}
