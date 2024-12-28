<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->get();

        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        if($request->validate([
            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'stock' => 'required',
            'stock_min' => 'required',
            'stock_max' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ]));

        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_min = $request->stock_min;
        $producto->stock_max = $request->stock_max;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;
        if($request->hasFile('imagen_producto')) {
            $producto->imagen = $request->file('imagen_producto')->store('productos', 'public');
        };
        $producto->save();

        // REDIRECCIONAR AL INDEX DE PRODUCTOS //
        return redirect()->route('admin.productos.index')->with('mensaje','Se ha creado el Producto exitosamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $categoria = Categoria::find($producto->categoria_id);

        return view('admin.productos.show', compact('producto', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();

        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'codigo' => 'required|unique:productos,codigo,'.$id,
            'nombre' => 'required',
            'stock' => 'required',
            'stock_min' => 'required',
            'stock_max' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ]);

        $producto = Producto::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_min = $request->stock_min;
        $producto->stock_max = $request->stock_max;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        if($request->hasFile('imagen_producto')) {
            Storage::delete('public/'.$producto->imagen);
            $producto->imagen = $request->file('imagen_producto')->store('productos', 'public');
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto actualizado con éxito')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        Producto::destroy($id);
        // ELIMINAR LA IMAGEN DEL PRODUCTO DEL STORAGE(DISCO) //
        Storage::delete('public/'.$producto->imagen);

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado con éxito')->with('icono', 'success');
    }
}
