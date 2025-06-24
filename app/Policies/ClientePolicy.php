<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class ClientePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Clientes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Cliente $cliente): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Clientes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Cliente $cliente): bool
    {
        return $usuario->tienePermiso('Editar Clientes');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Cliente $cliente): bool
    {
        return $usuario->tienePermiso('Eliminar Clientes');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Cliente $cliente): bool
    {
         return $usuario->tienePermiso('Ver Clientes');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Cliente $cliente): bool
    {
        return false; 
    }
}
