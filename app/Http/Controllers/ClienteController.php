<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Registro público de cliente

    public function publicRegister()
    {
        $isCliente = Auth::guard('cliente')->check();
        $isUsuario = Auth::guard('web')->check();
        return view('pages.access.register', compact('isCliente', 'isUsuario'));
    }

    // Vista principal de gestión de clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('pages.gestion.clientes.index', [
            'clientes' => $clientes,
            'eliminados' => false
        ]);
    }

    // Vista formulario de registro de cliente (admin)
    public function create()
    {
        return view('pages.gestion.clientes.create');
    }

    // Guardar cliente (público o admin)
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'apellido_cliente' => 'required|string|max:100',
            'correo_cliente'  => 'required|email|unique:clientes,correo_cliente',
            'password_cliente' => 'required|string|min:6',
            'telefono_cliente' => 'nullable|string|max:20',
            'direccion_cliente' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::create([
            'nombre_cliente'  => $request->nombre_cliente,
            'apellido_cliente' => $request->apellido_cliente,
            'correo_cliente'   => $request->correo_cliente,
            'password_cliente' => $request->password_cliente, // Se encripta automáticamente en el modelo
            'telefono_cliente' => $request->telefono_cliente,
            'direccion_cliente' => $request->direccion_cliente,
        ]);

        if ($request->has('registro_publico')) {

            // Login automático después de registrar
            Auth::guard('cliente')->login($cliente);
            return redirect()->route('index')
                ->with('success', '¡Bienvenido! Tu cuenta fue creada.');
        } else {
            // Registro desde el admin clientes
            return redirect()->route('cliente.index')
                ->with('success', 'Cliente registrado correctamente.');
        }
    }

    // Mostrar clientes eliminados (soloTrashed)
    public function eliminados()
    {
        $clientes = Cliente::onlyTrashed()->get();
        return view('pages.gestion.clientes.index', [
            'clientes' => $clientes,
            'eliminados' => true
        ]);
    }

    // Editar cliente (formulario)
    public function edit($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return view('pages.gestion.clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, $id_cliente)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'apellido_cliente' => 'required|string|max:100',
            'correo_cliente'  => 'required|email|unique:clientes,correo_cliente,' . $id_cliente . ',id_cliente',
            'telefono_cliente' => 'nullable|regex:/^[0-9]+$/|max:20',
            'direccion_cliente' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente = $request->apellido_cliente;
        $cliente->correo_cliente = $request->correo_cliente;
        $cliente->telefono_cliente = $request->telefono_cliente;
        $cliente->direccion_cliente = $request->direccion_cliente;
        $cliente->save();

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente (soft delete)
    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        $cliente->delete();

        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente.');
    }

    // Restaurar cliente eliminado
    public function restore($id_cliente)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id_cliente);
        $cliente->restore();

        return redirect()->route('cliente.index')->with('success', 'Cliente restaurado correctamente.');
    }

    /**
     * Logout para clientes.
     */

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
