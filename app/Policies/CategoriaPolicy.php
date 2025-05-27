<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class CategoriaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Ver Categorias');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Categoria $categoria): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->tienePermiso('Agregar Categorias');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Categoria $categoria): bool
    {
        return $usuario->tienePermiso('Editar Categorias');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Categoria $categoria): bool
    {
        return $usuario->tienePermiso('Eliminar Categorias');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Categoria $categoria): bool
    {
        return $usuario->tienePermiso('Eliminar Categorias');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Categoria $categoria): bool
    {
        return false; 
    }
}
