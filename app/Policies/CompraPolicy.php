<?php

namespace App\Policies;

use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class CompraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Compras');
    }

    /**
     * Determine whether the user can view the Compra model.
     */
    public function view(Usuario $usuario, Compra $compra): bool
    {
        return $usuario->tienePermiso('Ver Compras');
    }

    /**
     * Determine whether the user can create Compra models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Compras');
    }

    /**
     * Determine whether the user can update the Compra model.
     */
    public function update(Usuario $usuario, Compra $compra): bool
    {
        return $usuario->tienePermiso('Editar Compras');
    }

    /**
     * Determine whether the user can delete the Compra model.
     */
    public function delete(Usuario $usuario, Compra $compra): bool
    {
        return $usuario->tienePermiso('Eliminar Compras');
    }

    /**
     * Determine whether the user can restore the Compra model.
     */
    public function restore(Usuario $usuario, Compra $compra): bool
    {
        return $usuario->tienePermiso('Ver Compras');
    }

    /**
     * Determine whether the user can permanently delete the Compra model.
     */
    public function forceDelete(Usuario $usuario, Compra $compra): bool
    {
        return false;
    }
}
