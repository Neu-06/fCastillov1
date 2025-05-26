<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\DetalleProducto;
use App\Models\ImagenProducto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            // Crear producto
            $producto = Producto::create([
                'codigo_producto' => $request->codigo_producto,
                'nombre_producto' => $request->nombre_producto,
                'id_categoria' => $request->id_categoria,
            ]);

            // Crear detalle del producto
            $detalle = DetalleProducto::create([
                'id_producto' => $producto->id_producto,
                'descripcion' => $request->descripcion,
                'id_marca' => $request->id_marca,
                'precio_venta' => 0,
                'precio_compra' => 0,
                'costo_promedio' => 0,
            ]);

            // Subir imágenes a Cloudinary
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $upload = Cloudinary::upload($imagen->getRealPath(), [
                        'folder' => 'ferreteria/productos'
                    ]);

                    ImagenProducto::create([
                        'id_dproducto' => $detalle->id_dproducto,
                        'ruta' => $upload->getSecurePath(),
                        'public_id' => $upload->getPublicId(),
                    ]);
                }
            }
        });

        return redirect()->route('producto.index')->with('success', 'Producto registrado correctamente.');
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
            'descripcion' => 'nullable|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
        ]);

        DB::transaction(function () use ($request, $id_producto) {
            $producto = Producto::findOrFail($id_producto);
            $producto->update([
                'codigo_producto' => $request->codigo_producto,
                'nombre_producto' => $request->nombre_producto,
                'id_categoria' => $request->id_categoria,
            ]);

            $detalle = $producto->detalle;
            $detalle->update([
                'descripcion' => $request->descripcion,
                'id_marca' => $request->id_marca,
            ]);
        });

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    // ✅ Eliminar producto (Soft delete real con deleted_at)
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }

    // ✅ Mostrar productos eliminados
    public function eliminados()
    {
        $productos = Producto::onlyTrashed()->with(['detalle', 'detalle.marca', 'detalle.imagenes', 'categoria'])->get();

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'eliminados' => true
        ]);
    }

    // ✅ Restaurar un producto eliminado
    public function restore($id_producto)
    {
        $producto = Producto::withTrashed()->findOrFail($id_producto);
        $producto->restore();

        return redirect()->route('producto.index')->with('success', 'Producto restaurado correctamente.');
    }
}
