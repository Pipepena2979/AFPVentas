<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles')->get();

        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
        $session_id = session()->getId();
        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Excluir los campos innecesarios y devolver la respuesta
        // $datosEmpresa = $request->except(['codigo', 'id_proveedor']);
        // return response()->json($datosEmpresa);
        
        $request->validate([
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_compra' => 'required|numeric', 
        ]);

        $session_id = session()->getId();

        $compra = new Compra();
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_compra; 
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->id_proveedor;
        $compra->save();

        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        foreach($tmp_compras as $tmp_compra) {
            
            $producto = Producto::where('id', $tmp_compra->producto_id)->first();
            
            $detalle_compra = new DetalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;
            $detalle_compra->save();

            $producto->stock += $tmp_compra->cantidad;
            $producto->save();
        }

        TmpCompra::where('session_id', $session_id)->delete();

        // REDIRECCIONAR AL INDEX DE COMPRAS //
        return redirect()->route('admin.compras.index')->with('mensaje','Se ha creado la compra exitosamente')->with('icono', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);

        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();

        return view('admin.compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Excluir los campos innecesarios y devolver la respuesta
        // $datosEmpresa = $request->except(['codigo', 'id_proveedor']);
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_compra' => 'required|numeric', 
        ]);

        $compra = Compra::findOrFail($id);
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_compra; 
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->id_proveedor;
        $compra->save();

        // REDIRECCIONAR AL INDEX DE COMPRAS //
        return redirect()->route('admin.compras.index')->with('mensaje','Se ha actualizado la compra exitosamente')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);

        foreach($compra->detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->detalles()->delete();
        $compra->delete();


        // REDIRECCIONAR AL INDEX DE COMPRAS //
        return redirect()->route('admin.compras.index')->with('mensaje', 'Compra eliminada con éxito')->with('icono', 'success');
    }
}
