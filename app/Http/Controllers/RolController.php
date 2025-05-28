<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Permiso;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $this->authorize('viewAny', Rol::class);
        $roles = Rol::all(); // Obtener todos los roles
        return view('pages.gestion.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Rol::class);
        // Obtener todos los permisos desde la base de datos
        $permisos = Permiso::all();

        // Definir los casos de uso disponibles (coinciden con el formato en nombre_permiso)
        $casosDeUso = [
            'Gestionar Usuarios',
            'Gestionar Roles',
            'Gestionar Permisos',
            'Gestionar Proveedores',
            'Gestionar Clientes'
        ];



        // Retornar la vista con los datos necesarios
        return view('pages.gestion.roles.create', compact('permisos', 'casosDeUso'));
    }

    public function edit($id_rol)
{
    $rol = Rol::findOrFail($id_rol);

    $this->authorize('update', $rol); // Protege con política

    $permisos = Permiso::all();

    $casosDeUso = [
        'Gestionar Usuarios',
        'Gestionar Roles',
        'Gestionar Permisos',
        'Gestionar Proveedores',
        'Gestionar Clientes',
    ];

    return view('pages.gestion.roles.edit', compact('rol', 'permisos', 'casosDeUso'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Rol::class);
        // Validamos que el nombre del rol sea obligatorio, único y que los permisos (si vienen) sean válidos.
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:rols,nombre_rol',

            // Validamos que permisos sea un arreglo (puede estar vacío si no se selecciona ninguno)
            'permisos' => 'array',

            // Validamos que cada permiso exista realmente en la tabla permisos
            'permisos.*' => 'exists:permisos,id_permiso',
        ]);
        // Se crea el nuevo rol en la base de datos con el nombre recibido
        $rol = Rol::create([
            'nombre_rol' => $request->nombre_rol,
        ]);
        // Si vienen permisos marcados, se sincronizan con el nuevo rol
        if ($request->has('permisos')) {
            // Esto inserta en la tabla permiso_rol: (id_rol, id_permiso) por cada uno
            $rol->permisos()->sync($request->permisos);
        }
        return redirect()->route('rol.index')->with('success', 'Rol registrado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rol)
    {
        $rol = Rol::findOrFail($id_rol);
        $this->authorize('delete', $rol);

        // Verificar si tiene usuarios asociados
        if ($rol->usuarios()->count() > 0) {
            return redirect()->route('rol.index')
                ->with('error', 'No se puede eliminar el rol porque tiene usuarios asociados.');
        }

        $rol->delete();

        return redirect()->route('rol.index')->with('success', 'Rol eliminado correctamente.');
    }

public function update(Request $request, $id_rol)
{
    // 🔐 1. Buscar el rol a editar
    $rol = Rol::findOrFail($id_rol);

    // 🔐 2. Verificar si el usuario tiene permiso para editar este rol
    $this->authorize('update', $rol);

    // ✅ 3. Validar los datos del formulario
    $request->validate([
        'nombre_rol' => 'required|string|max:50|unique:rols,nombre_rol,' . $id_rol . ',id_rol',
        'permisos' => 'array', // Puede venir vacío
        'permisos.*' => 'exists:permisos,id_permiso',
    ]);

    // 📝 4. Actualizar el nombre del rol
    $rol->nombre_rol = $request->nombre_rol;
    $rol->save();

    // 🔗 5. Sincronizar los permisos del rol (actualiza la tabla pivote permiso_rol)
    $rol->permisos()->sync($request->permisos ?? []);

    // ✅ 6. Redirigir con mensaje de éxito
    return redirect()->route('rol.index')->with('success', 'Rol actualizado correctamente.');
}


    public function verPermisos($id)
    {
        $rol = Rol::with('permisos')->findOrFail($id);
        $permisos = Permiso::all();

        $casosDeUso = [
            'Gestionar Usuarios',
            'Gestionar Roles',
            'Gestionar Permisos',
            'Gestionar Proveedores',
            'Gestionar Clientes',
            'Gestionar Productos',
            'Gestionar Marcas',
            'Gestionar Categorias',
        ];

        return view('pages.gestion.roles.permisos', compact('rol', 'permisos', 'casosDeUso'));
    }
}
