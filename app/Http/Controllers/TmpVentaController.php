<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TmpVenta;
use Illuminate\Http\Request;

class TmpVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function tmp_ventas(Request $request) {
        $producto = Producto::where('codigo', $request->codigo)->first();
        $session_id = session()->getId();

        if($producto) {

            $tmp_venta_existe = TmpVenta::where('producto_id', $producto->id)->where('session_id', $session_id)
            ->first();

            if($tmp_venta_existe) {
                $tmp_venta_existe->cantidad += $request->cantidad;
                $tmp_venta_existe->save();
                return response()->json(['success'=>true,'message'=>'El producto fue encontrado']);
            } else {
                $tmpVenta = new TmpVenta();
                $tmpVenta->cantidad = $request->cantidad;
                $tmpVenta->producto_id = $producto->id;
                $tmpVenta->session_id = $session_id;

                $tmpVenta->save();

                return response()->json(['success'=>true,'message'=>'El producto fue encontrado']);
            }
        } else {
            return response()->json(['success'=>false,'message'=>'Producto no encontrado']);
        }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TmpVenta::destroy($id);

        return response()->json(['success'=>true]);
    }
}
