<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function showRegister()
    {
        return view('pages.access.register');
    }

    public function store(Request $request)
    {
        // Verifica si los datos que se están enviando son correctos
        //dd($request->all());

        // Validación de los datos
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'apellido_cliente' => 'required|string|max:100',
            'correo_cliente'  => 'required|email|unique:clientes,correo_cliente',
            'password_cliente' => 'required|string|min:6',
            'telefono_cliente' => 'nullable|string|max:20',
            'direccion_cliente' => 'nullable|string|max:255',
        ]);

        // Crear el nuevo cliente
        Cliente::create([
            'nombre_cliente'  => $request->nombre_cliente,
            'apellido_cliente' => $request->apellido_cliente,
            'correo_cliente'   => $request->correo_cliente,
            'password_cliente' => $request->password_cliente, // Se encripta automáticamente en el modelo
            'telefono_cliente' => $request->telefono_cliente,
            'direccion_cliente' => $request->direccion_cliente,
        ]);

        return redirect()->route('login')->with('success', 'Cliente registrado exitosamente. Inicia sesión.');
    }


    // public function login(Request $request)
    // {// Validar datos de entrada
    //     $request->validate([
    //         'correo' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Intentar autenticar como usuario administrativo
    //     $usuario = Usuario::where('correo_usuario', $request->correo)->first();
    //     if ($usuario && Hash::check($request->password, $usuario->password_usuario)) {
    //         Auth::login($usuario);

    //         // Redirigir según el rol
    //         switch ($usuario->rol->nombre_rol) {
    //             case 'Administrador':
    //                 return redirect()->route('vista.administrador.home');
    //             case 'Vendedor':
    //                 return redirect()->route('vista.vendedor.home');
    //             default:
    //                 Auth::logout();
    //                 return redirect()->route('login')->with('error', 'Rol no válido.');
    //         }
    //     }

    //     // Intentar autenticar como cliente
    //     $cliente = Cliente::where('correo_cliente', $request->correo)->first();
    //     if ($cliente && Hash::check($request->password, $cliente->password_cliente)) {
    //         Auth::login($cliente);

    //         // Redirigir a la vista del e-commerce
    //         return redirect()->route('ecommerce.home');
    //     }

    //     // Si no se encuentra en ninguna tabla
    //     return back()->with('error', 'Correo o contraseña incorrectos.');
    // }

    /**
     * Logout para usuarios y clientes.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
