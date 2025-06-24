<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Auth\Access\Response;

class VentaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Ventas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Ventas');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->tienePermiso('Editar Ventas');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->tienePermiso('Eliminar Ventas');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->tienePermiso('Ver Ventas');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }
}
