<?php

namespace App\Policies;

use App\Models\Permiso;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class PermisoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Permisos'); 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Permiso $permiso): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Permisos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Permiso $permiso): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Permiso $permiso): bool
    {
        return $usuario->tienePermiso('Eliminar Permisos');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Permiso $permiso): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Permiso $permiso): bool
    {
        return false; 
    }
}
