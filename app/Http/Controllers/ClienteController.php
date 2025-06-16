<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\BitacoraController;

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
    {   $this->authorize('viewAny', Cliente::class);
        $clientes = Cliente::all();
        return view('pages.gestion.clientes.index', [
            'clientes' => $clientes,
            'eliminados' => false
        ]);
    }

    // Vista formulario de registro de cliente (admin)
    public function create()
    {
        $this->authorize('create', Cliente::class);
        return view('pages.gestion.clientes.create');
    }

/**
 * Guarda un nuevo cliente.
 * Si el registro viene del panel admin → protege con Policy.
 * Si viene del público (registro externo) → omite autorización.
 */
    public function store(Request $request)
    {
    // Si el registro viene del panel de administración, verificar permiso
    if (!$request->has('registro_publico')) {
        $this->authorize('create', Cliente::class);
    }

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
 // Si fue desde el formulario público, hacer login automático y redirigir

        BitacoraController::registrar(
            'CREAR',
            'Se creó el cliente: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente
        );

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
    {   $this->authorize('viewAny', Cliente::class);
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
         $this->authorize('update', $cliente);
        return view('pages.gestion.clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, $id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
         // Autorizar la acción (Editar Cliente)
        $this->authorize('update', $cliente);
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'apellido_cliente' => 'required|string|max:100',
            'correo_cliente'  => 'required|email|unique:clientes,correo_cliente,' . $id_cliente . ',id_cliente',
            'telefono_cliente' => 'nullable|regex:/^[0-9]+$/|max:20',
            'direccion_cliente' => 'nullable|string|max:255',
        ]);

        
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente = $request->apellido_cliente;
        $cliente->correo_cliente = $request->correo_cliente;
        $cliente->telefono_cliente = $request->telefono_cliente;
        $cliente->direccion_cliente = $request->direccion_cliente;
        $cliente->save();

        BitacoraController::registrar(
            'ACTUALIZAR',
            'Se actualizó el cliente: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente
        );

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente (soft delete)
    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        $this->authorize('delete', $cliente);
        $cliente->delete();
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó el cliente: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente
        );
        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente.');
    }

    // Restaurar cliente eliminado
    public function restore($id_cliente)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id_cliente);
        $this->authorize('restore', $cliente);
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
