<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\DetalleProducto;
use App\Models\ImagenProducto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Cloudinary\Cloudinary;

class ProductoController extends Controller
{
    // ✅ Listar productos activos (no eliminados)
    public function index()
    {
        $productos = Producto::with(['detalle', 'detalle.marca', 'detalle.imagenes', 'categoria'])->get();

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'eliminados' => false
        ]);
    }

    // ✅ Mostrar formulario de creación
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
            // … tus reglas …
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1) Crear producto y detalle en transacción
        DB::transaction(function () use ($request, &$detalle) {
            $producto = Producto::create([
                'codigo_producto' => $request->codigo_producto,
                'nombre_producto' => $request->nombre_producto,
                'id_categoria'    => $request->id_categoria,
            ]);
            $detalle = DetalleProducto::create([
                'id_producto'   => $producto->id_producto,
                'descripcion'   => $request->descripcion,
                'id_marca'      => $request->id_marca,
                'precio_venta'  => 0,
                'precio_compra' => 0,
                'costo_promedio' => 0,
            ]);
        });

        // 2) Configurar SDK oficial de Cloudinary
        // Instancia principal
        $cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => [
                    'secure' => true,
                ]
            ]
        );

        // 3) Subir imágenes y guardar en BD
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                if ($imagen->isValid()) {
                    $result = $cloudinary->uploadApi()->upload(
                        $imagen->getRealPath(),
                        [
                            'folder'        => 'ferreteria/' . $request->id_categoria . '/' . $request->id_marca,
                            'quality'       => 'auto',
                            'fetch_format'  => 'auto',
                        ]
                    );

                    ImagenProducto::create([
                        'id_dproducto' => $detalle->id_dproducto,
                        'ruta_imagen'  => $result['secure_url'],
                        'public_id'    => $result['public_id'],
                    ]);
                }
            }
        }

        return redirect()->route('producto.index')
            ->with('success', 'Producto registrado correctamente.');
    }





    // ✅ Mostrar formulario de edición
    public function edit($id_producto)
    {
        $producto = Producto::with(['detalle', 'detalle.imagenes'])->findOrFail($id_producto);
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

    // Instancia del SDK v2 de Cloudinary
    $cloudinary = new Cloudinary([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],
        'url' => ['secure' => true],
    ]);

    DB::transaction(function () use ($request, $id_producto, $cloudinary) {
        $producto = Producto::with('detalle.imagenes')->findOrFail($id_producto);

        // ✅ Actualizar datos del producto
        $producto->update([
            'codigo_producto' => $request->codigo_producto,
            'nombre_producto' => $request->nombre_producto,
            'id_categoria'    => $request->id_categoria,
        ]);

        // ✅ Actualizar detalle del producto
        $detalle = $producto->detalle;
        $detalle->update([
            'descripcion' => $request->descripcion,
            'id_marca'    => $request->id_marca,
        ]);

        // ✅ Eliminar imágenes seleccionadas
        if ($request->has('imagenes_eliminar')) {
            foreach ($detalle->imagenes as $imagen) {
                if (in_array($imagen->id_imagen, $request->imagenes_eliminar)) {
                    $cloudinary->uploadApi()->destroy($imagen->public_id); // elimina de Cloudinary
                    $imagen->delete(); // elimina de la base de datos
                }
            }
        }

        // ✅ Subir nuevas imágenes si las hay
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagenNueva) {
                if ($imagenNueva->isValid()) {
                    $upload = $cloudinary->uploadApi()->upload(
                        $imagenNueva->getRealPath(),
                        [
                            'folder'        => 'ferreteria/' . $request->id_categoria . '/' . $request->id_marca,
                            'quality'       => 'auto',
                            'fetch_format'  => 'auto',
                        ]
                    );

                    ImagenProducto::create([
                        'id_dproducto' => $detalle->id_dproducto,
                        'ruta_imagen'  => $upload['secure_url'],
                        'public_id'    => $upload['public_id'],
                    ]);
                }
            }
        }
    });

    return redirect()->route('producto.index')
                     ->with('success', 'Producto actualizado correctamente.');
}


    // ✅ Eliminar producto (Soft delete real con deleted_at)


public function destroy($id_producto)
{
    // Buscar el producto con detalle e imágenes
    $producto = Producto::with('detalle.imagenes')->findOrFail($id_producto);

    // Instancia de Cloudinary
    $cloudinary = new Cloudinary([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],
        'url' => ['secure' => true],
    ]);

    // Eliminar imágenes de Cloudinary (pero aún no de la BD)
    if ($producto->detalle && $producto->detalle->imagenes) {
        foreach ($producto->detalle->imagenes as $imagen) {
            $cloudinary->uploadApi()->destroy($imagen->public_id);
            // Nota: no eliminamos la fila de BD porque es soft delete del producto
        }
    }

    // Soft delete del producto (se guarda en la papelera)
    $producto->delete();

    return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
}


    // ✅ Mostrar productos eliminados
public function eliminados()
{
    $productos = Producto::onlyTrashed()
        ->with(['detalle', 'detalle.marca', 'detalle.imagenes', 'categoria'])
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
