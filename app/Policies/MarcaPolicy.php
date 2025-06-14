<?php

namespace App\Policies;

use App\Models\Marca;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class MarcaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Marcas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Marca $marca): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Crear Marcas');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Marca $marca): bool
    {
        return $usuario->tienePermiso('Editar Marcas');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Marca $marca): bool
    {
        return $usuario->tienePermiso('Eliminar Marcas');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Marca $marca): bool
    {
        return $usuario->tienePermiso('Ver Marcas');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Marca $marca): bool
    {
        return false; 
    }
}
