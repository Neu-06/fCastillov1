<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Producto;

use App\Models\ImagenProducto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['marca', 'imagenes', 'categoria'])->get();
        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'eliminados' => false
        ]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('pages.gestion.productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_producto' => 'required|unique:productos,codigo_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion'     => 'nullable|string|max:255',
            'id_categoria'    => 'required|exists:categorias,id_categoria',
            'id_marca'        => 'required|exists:marcas,id_marca',
            'imagenes'        => 'nullable|array|max:5',
            'imagenes.*'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120', //5mb maximo por imagen
        ]);


        // 1. Crear producto dentro de transacción
        $producto = DB::transaction(function () use ($request) {
            return Producto::create([
                'codigo_producto' => $request->codigo_producto,
                'nombre_producto' => $request->nombre_producto,
                'descripcion'     => $request->descripcion,
                'precio_venta'    => 0,
                'costo_promedio'  => 0,
                'precio_compra'   => 0,
                'stock'           => 0,
                'id_categoria'    => $request->id_categoria,
                'id_marca'        => $request->id_marca,
            ]);
        });

        if ($request->hasFile('imagenes')) {

            foreach ($request->file('imagenes') as $imagen) {
                if ($imagen->isValid()) {

                    $categoria = Categoria::findOrFail($request->id_categoria);
                    $nombreCategoria = Str::slug($categoria->nombre); 

                    $uploaded = Cloudinary::upload(
                        $imagen->getRealPath(),
                        [
                            'folder' => 'ferreteria/' . $nombreCategoria,
                        ]
                    );

                    $uploadedFileUrl = $uploaded->getSecurePath();
                    $publicId = $uploaded->getPublicId();

                    ImagenProducto::create([
                        'id_producto' => $producto->id_producto,
                        'ruta_imagen'  => $uploadedFileUrl,
                        'public_id'    => $publicId,
                    ]);
                }
            }
        }
        return redirect()->route('producto.index')
            ->with('success', 'Producto registrado correctamente.');
    }


    public function edit($id_producto)
    {
        $producto = Producto::with(['imagenes'])->findOrFail($id_producto);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('pages.gestion.productos.edit', compact('producto', 'categorias', 'marcas'));
    }


    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto,' . $id_producto . ',id_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion'     => 'nullable|string|max:255',
            'id_categoria'    => 'required|exists:categorias,id_categoria',
            'id_marca'        => 'required|exists:marcas,id_marca',
            'imagenes'        => 'nullable|array|max:5',
            'imagenes.*'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120', //5mb maximo por imagen
        ]);

        DB::transaction(function () use ($request, $id_producto) {
            $producto = Producto::with('imagenes')->findOrFail($id_producto);

            // Actualizar producto
            $producto->update([
                'codigo_producto' => $request->codigo_producto,
                'nombre_producto' => $request->nombre_producto,
                'descripcion'     => $request->descripcion,
                'id_categoria'    => $request->id_categoria,
                'id_marca'        => $request->id_marca,
            ]);

            // Eliminar imágenes seleccionadas
            if ($request->filled('imagenes_eliminar') && is_array($request->imagenes_eliminar)) {
                foreach ($producto->imagenes as $imagen) {
                    if (in_array($imagen->id_imagen, $request->imagenes_eliminar)) {
                        Cloudinary::destroy($imagen->public_id);
                        $imagen->delete();
                    }
                }
            }

            // Subir nuevas imágenes
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagenNueva) {
                    if ($imagenNueva->isValid()) {
                        $categoria = Categoria::findOrFail($request->id_categoria);
                        $nombreCategoria = Str::slug($categoria->nombre);

                        $upload = Cloudinary::upload(
                            $imagenNueva->getRealPath(),
                            [
                                'folder' => 'ferreteria/' . $nombreCategoria,
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
            }
        });

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }




    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);

        // Validar que el stock sea 0
        if ($producto->stock > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar un producto con stock mayor a 0.');
        }

        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }


    // ✅ Mostrar productos eliminados
    public function eliminados()
    {
        $productos = Producto::onlyTrashed()
            ->with(['marca', 'imagenes', 'categoria'])
            ->get();

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
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
