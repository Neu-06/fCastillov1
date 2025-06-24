<?php

namespace App\Policies;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class RolPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Roles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Rol $rol): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Roles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Rol $rol): bool
    {
        return $usuario->tienePermiso('Editar Roles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Rol $rol): bool
    {
        return $usuario->tienePermiso('Eliminar Roles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Rol $rol): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Rol $rol): bool
    {
        return false; 
    }
}
