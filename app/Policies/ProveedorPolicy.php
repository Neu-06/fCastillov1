<?php

namespace App\Policies;

use App\Models\Proveedor;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class ProveedorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Proveedores');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Proveedor $proveedor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Proveedores');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Proveedor $proveedor): bool
    {
        return $usuario->tienePermiso('Editar Proveedores');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Proveedor $proveedor): bool
    {
        return $usuario->tienePermiso('Eliminar Proveedores');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Proveedor $proveedor): bool
    {
        return $usuario->tienePermiso('Ver Proveedores'); // o "Restaurar Usuarios" si existe
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Proveedor $proveedor): bool
    {
        return false;
    }
}
