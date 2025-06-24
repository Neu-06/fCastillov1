<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Productos');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Producto $producto): bool
    {
        return false; 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Crear Productos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Producto $producto): bool
    {
        return $usuario->tienePermiso('Editar Productos');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Producto $producto): bool
    {
        return $usuario->tienePermiso('Eliminar Productos');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Producto $producto): bool
    {
        return $usuario->tienePermiso('Ver Productos');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Producto $producto): bool
    {
        return false;
    }
}
