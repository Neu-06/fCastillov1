<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
//use Cloudinary\Laravel\Facades\Cloudinary;

use App\Models\Producto;

use App\Models\ImagenProducto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
       // $productos = Producto::with(['marca', 'imagenes', 'categoria'])->get();
        //dd($productos->first()); // inspecciona solo el primer producto
        $categorias = Categoria::all();

        // Traer productos con o sin filtro
        $productos = Producto::with(['marca', 'imagenes', 'categoria'])
            ->when($request->categoria_id, function ($query, $categoriaId) {
                return $query->where('id_categoria', $categoriaId);
            })
            ->get();

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'eliminados' => false
        ]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('pages.gestion.productos.create', compact('categorias', 'marcas'));
    }

    // ✅ Guardar producto en las tablas respectivas



    public function store(Request $request)
{
    $request->validate([
        'codigo_producto' => 'required|unique:productos,codigo_producto',
        'nombre_producto' => 'required|string|max:100',
        'descripcion'     => 'nullable|string|max:255',
        'id_categoria'    => 'required|exists:categorias,id_categoria',
        'id_marca'        => 'required|exists:marcas,id_marca',
        'imagenes'        => 'nullable|array|max:5',
        'imagenes.*'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $producto = DB::transaction(function () use ($request) {
        return Producto::create([
            'codigo_producto' => $request->input('codigo_producto'),
            'nombre_producto' => $request->input('nombre_producto'),
            'descripcion'     => $request->input('descripcion'),
            'precio_venta'    => 0,
            'costo_promedio'  => 0,
            'precio_compra'   => 0,
            'stock'           => 0,
            'id_categoria'    => $request->input('id_categoria'),
            'id_marca'        => $request->input('id_marca'),
        ]);
    });

    if ($request->hasFile('imagenes')) {
        $categoria = Categoria::findOrFail($request->input('id_categoria'));
        $nombreCategoria = Str::slug($categoria->nombre_categoria);

        foreach ($request->file('imagenes') as $imagen) {
            if ($imagen->isValid()) {
                try {
                    $upload = Cloudinary::upload(
                        $imagen->getRealPath(),
                        ['folder' => 'ferreteria/' . $nombreCategoria]
                    );

                    ImagenProducto::create([
                        'id_producto' => $producto->id_producto,
                        'ruta_imagen' => $upload->getSecurePath(),
                        'public_id'   => $upload->getPublicId(),
                    ]);
                } catch (\Exception $e) {
                    // Aquí podrías loggear el error si quieres
                    continue; // Salta imagen con error
                }
            }
        }
        return redirect()->route('producto.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    return redirect()->route('producto.index')
        ->with('success', 'Producto registrado correctamente.');
}





    // ✅ Mostrar formulario de edición
    public function edit($id_producto)
    {
        $producto = Producto::with(['imagenes'])->findOrFail($id_producto);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('pages.gestion.productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    // ✅ Actualizar producto


    public function update(Request $request, $id_producto)
{
    $request->validate([
        'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto,' . $id_producto . ',id_producto',
        'nombre_producto' => 'required|string|max:100',
        'descripcion'     => 'nullable|string|max:255',
        'id_categoria'    => 'required|exists:categorias,id_categoria',
        'id_marca'        => 'required|exists:marcas,id_marca',
        'imagenes.*'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    DB::transaction(function () use ($request, $id_producto) {
        $producto = Producto::with('imagenes')->findOrFail($id_producto);

        // Actualizar producto
        $producto->update([
            'codigo_producto' => $request->codigo_producto,
            'nombre_producto' => $request->nombre_producto,
            'descripcion'     => $request->descripcion,
            'id_categoria'    => $request->id_categoria,
            'id_marca'        => $request->id_marca, // CORREGIDO
        ]);

        // Eliminar imágenes seleccionadas
        if ($request->filled('imagenes_eliminar') && is_array($request->imagenes_eliminar)) {
            foreach ($producto->imagenes as $imagen) {
                if (in_array($imagen->id_imagen, $request->imagenes_eliminar)) {
                    Cloudinary::destroy($imagen->public_id); // CORREGIDO
                    $imagen->delete();
                }
            }

        // Subir nuevas imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagenNueva) {
                if ($imagenNueva->isValid()) {
                    $upload = Cloudinary::upload(
                        $imagenNueva->getRealPath(),
                        [
                            'folder'        => 'ferreteria/' . $request->id_categoria . '/' . $request->id_marca,
                            'quality'       => 'auto',
                            'fetch_format'  => 'auto',
                        ]
                    );

                    ImagenProducto::create([
                        'id_producto'  => $producto->id_producto, // CORREGIDO
                        'ruta_imagen'  => $upload->getSecurePath(),
                        'public_id'    => $upload->getPublicId(),
                    ]);
                }
            }
        });

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    // ✅ Eliminar producto (Soft delete real con deleted_at)


    public function destroy($id_producto)
    {
        // Buscar el producto con detalle e imágenes
        $producto = Producto::with('imagenes')->findOrFail($id_producto);

        // Eliminar imágenes de Cloudinary (pero no de la base de datos aún)
        if ($producto->imagenes) {
            foreach ($producto->imagenes as $imagen) {
                Cloudinary::destroy($imagen->public_id);
                // Nota: no eliminamos la fila de BD porque es soft delete del producto
            }
        }

        // Soft delete del producto (se guarda en la papelera)
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }

 
    public function eliminados(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::onlyTrashed()
            ->with(['marca', 'imagenes', 'categoria'])
            ->get();

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'eliminados' => true
        ]);
    }
    //restaurar un producto eliminado
    public function restore($id_producto)
    {
        $producto = Producto::withTrashed()->findOrFail($id_producto);
        $producto->restore();
        return redirect()->route('producto.index')->with('success', 'Producto restaurado correctamente.');
    }
}
