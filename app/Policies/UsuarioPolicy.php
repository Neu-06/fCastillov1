<?php

namespace App\Policies;

use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class UsuarioPolicy
{     /**
     * Determina si el usuario autenticado puede ver la lista completa de usuarios.
     */
    public function viewAny(Usuario $authUser): bool
    {
        return $authUser->tienePermiso('Ver Usuarios');
    }


    /**
     * Determina si el usuario autenticado puede ver la lista completa de usuarios.
     */
    public function create(Usuario $authUser): bool
    {
        //par ver si muestra el boton de Agregar Usuario, o el formulario de crear usuario 
        //Mostrar botón o formulario de crear usuario
        return $authUser->tienePermiso('Agregar Usuarios');
    }


    /**
     * Determina si puede acceder al formulario o botón de edición de un usuario.
     */
    public function update(Usuario $authUser, Usuario $usuario): bool
    {//Mostrar botón de editar un usuario
        return $authUser->tienePermiso('Editar Usuarios');
    }

    /**
     * Determina si puede eliminar lógicamente a un usuario (soft delete).
     */    
    public function delete(Usuario $authUser, Usuario $usuario): bool
    {//Mostrar botón de eliminar un usuario
        return $authUser->tienePermiso('Eliminar Usuarios');
    }


    /**
     * Determina si puede restaurar un usuario eliminado lógicamente.
     */    
    public function restore(Usuario $authUser, Usuario $usuario): bool
    {
        //permite determinar si un uusario tiene permiso para restaurar
        //un registro elimnado logicamente usando softDeletes
        //return false; // o true, según tu lógica
        return $authUser->tienePermiso('Ver Usuarios'); // o "Restaurar Usuarios" si existe
    }

}
