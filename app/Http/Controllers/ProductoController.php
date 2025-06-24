<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Models\Categoria;
use App\Models\Marca;
use  App\Models\Estante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();

          $productos = Producto::with(['marca', 'imagenes', 'categoria', 'estante'])
        ->when($request->categoria_id, function ($query, $categoriaId) {
            return $query->where('id_categoria', $categoriaId);
        })
        ->when($request->busqueda, function ($query, $busqueda) {
            return $query->where(function ($q) use ($busqueda) {
                $q->where('nombre_producto', 'like', "%$busqueda%")
                  ->orWhere('codigo_producto', 'like', "%$busqueda%");
            });
        })
            ->paginate(10);

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'eliminados' => false
        ]);
    }

    public function show($id_producto)
    {
        $producto = Producto::with(['imagenes', 'categoria', 'marca', 'estante'])->findOrFail($id_producto);

        return view('pages.gestion.productos.show', compact('producto'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $estantes = Estante::all();
        return view('pages.gestion.productos.create', compact('categorias', 'marcas', 'estantes'));
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
            'id_estante'        => 'required|exists:estantes,id_estante',
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
                'id_estante'        => $request->input('id_estante'),
            ]);
        });

        if ($request->hasFile('imagenes')) {


            foreach ($request->file('imagenes') as $imagen) {
                if ($imagen->isValid()) {
                    $categoria = Categoria::findOrFail($request->id_categoria);
                    $nombreCategoria = Str::slug($categoria->nombre);
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

            // Registrar en bitácora
            BitacoraController::registrar(
                'CREAR',
                'Se creó el producto: ' . $request->nombre_producto
            );

            return redirect()->route('producto.index')
                ->with('success', 'Producto registrado correctamente.');
        }

        return redirect()->route('producto.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    public function edit($id_producto)
    {
        $producto = Producto::with(['imagenes'])->findOrFail($id_producto);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $estantes = Estante::all();
        return view('pages.gestion.productos.edit', compact('producto', 'categorias', 'marcas', 'estantes'));
    }

    // ✅ Actualizar producto
    public function update(Request $request, $id_producto)
    {
      
        //$ruleMax = 5;
        foreach (
            Validator::make([], [
                'imagenes' => 'nullable|array|max:5',
            ])->getRules()['imagenes'] as $rule
        ) {
            if (is_string($rule) && str_starts_with($rule, 'max:')) {
                $ruleMax = (int) str_replace('max:', '', $rule);
            }
        }

        // calculo del total de imagenes
        $producto = Producto::with('imagenes')->findOrFail($id_producto);
        $imagenesActuales = $producto->imagenes->count();
        $imagenesAEliminar = collect($request->imagenes_eliminar)->count();
        $nuevasImagenes = $request->hasFile('imagenes') ? count($request->file('imagenes')) : 0;
        $totalFinal = $imagenesActuales - $imagenesAEliminar + $nuevasImagenes;

        if ($totalFinal > $ruleMax) {
            return back()
                ->withErrors(['imagenes' => "Solo puedes tener un máximo de $ruleMax imágenes por producto."])
                ->withInput();
        }

        // Paso 3: Validar campos normalmente
        $request->validate([
            'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto,' . $id_producto . ',id_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion'     => 'nullable|string|max:255',
            'id_categoria'    => 'required|exists:categorias,id_categoria',
            'id_marca'        => 'required|exists:marcas,id_marca',
            'id_estante'      => 'required|exists:estantes,id_estante',
            'imagenes'        => "nullable|array|max:$ruleMax",
            'imagenes.*'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
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
                'id_estante'      => $request->id_estante,
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
                            'id_producto'  => $producto->id_producto,
                            'ruta_imagen'  => $upload->getSecurePath(),
                            'public_id'    => $upload->getPublicId(),
                        ]);
                    }
                }
            }
        });
        // Registrar en bitácora
        BitacoraController::registrar(
            'ACTUALIZAR',
            'Se actualizó el producto: ' . $request->nombre_producto
        );
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


        // Registrar en bitácora
        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó el producto: ' . $producto->nombre_producto
        );
        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function eliminados()
    {
        $categorias = Categoria::all();
        $productos = Producto::onlyTrashed()
            ->with(['marca', 'imagenes', 'categoria', 'estante'])
            ->paginate(10);

        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'eliminados' => true
        ]);
    }

    // Restaurar un producto eliminado
    public function restore($id_producto)
    {
        $producto = Producto::withTrashed()->findOrFail($id_producto);
        $producto->restore();
        return redirect()->route('producto.index')->with('success', 'Producto restaurado correctamente.');
    }
}
