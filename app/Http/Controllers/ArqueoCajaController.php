<?php

namespace App\Http\Controllers;

use App\Models\ArqueoCaja;
use App\Models\MovimientoCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArqueoCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arqueoAbierto = ArqueoCaja::whereNull('fecha_cierre')->first();
        $arqueos = ArqueoCaja::with('movimientos')->get();

        foreach ($arqueos as $arqueo) {
            $arqueo->total_ingresos = $arqueo->movimientos()->where('tipo', 'INGRESO')->sum('monto');
            $arqueo->total_egresos = $arqueo->movimientos()->where('tipo', 'EGRESO')->sum('monto');
        }
        
        return view('admin.arqueos.index', compact('arqueos', 'arqueoAbierto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.arqueos.create');
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
            'fecha_apertura' => 'required',
        ]));

        $arqueoCaja = new ArqueoCaja();

        $arqueoCaja->fecha_apertura = $request->fecha_apertura;
        $arqueoCaja->monto_inicial = $request->monto_inicial;
        $arqueoCaja->observaciones = $request->observaciones;
        $arqueoCaja->empresa_id = Auth::user()->empresa_id;

        $arqueoCaja->save();

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.arqueos.index')->with('mensaje','Se ha creado el arqueo de caja exitosamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $arqueoCaja = ArqueoCaja::find($id);
        $movimientos = ArqueoCaja::find($id)->movimientos()->get();

        return view('admin.arqueos.show', compact('arqueoCaja', 'movimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $arqueoCaja = ArqueoCaja::find($id)->first();

        return view('admin.arqueos.edit', compact('arqueoCaja'));
    }

    public function ingreso_egreso($id) {

        $arqueoCaja = ArqueoCaja::find($id);

        return view('admin.arqueos.ingreso-egreso', compact('arqueoCaja'));
    }

    public function store_ingreso_egreso(Request $request) {
        
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        if($request->validate([
            'tipo' => 'required',
            'monto' => 'required',
        ]));

        $movimientoCaja = new MovimientoCaja();

        $movimientoCaja->tipo = $request->tipo;
        $movimientoCaja->monto = $request->monto;
        $movimientoCaja->descripcion = $request->descripcion;
        $movimientoCaja->arqueo_caja_id = $request->id_arqueo;

        $movimientoCaja->save();

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.arqueos.index')->with('mensaje','Se ha registrado el movimiento del arqueo de la caja exitosamente')->with('icono', 'success');
    }

    public function cierre($id) {

        $arqueoCaja = ArqueoCaja::find($id);

        return view('admin.arqueos.cierre', compact('arqueoCaja'));
    }

    public function store_cierre(Request $request) {
        
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        $arqueoCaja = ArqueoCaja::find($request->id_arqueo);

        if($request->validate([
            'fecha_cierre' => 'required',
            'monto_final' => 'required',
        ]));

        $arqueoCaja->fecha_cierre = $request->fecha_cierre;
        $arqueoCaja->monto_final = $request->monto_final;

        $arqueoCaja->save();

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.arqueos.index')->with('mensaje','Se ha registrado el cierre del arqueo de la caja exitosamente')->with('icono', 'success');
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
            'fecha_apertura' => 'required',
        ]);

        $arqueoCaja = ArqueoCaja::find($id);

        $arqueoCaja->fecha_apertura = $request->fecha_apertura;
        $arqueoCaja->monto_inicial = $request->monto_inicial;
        $arqueoCaja->observaciones = $request->observaciones;
        $arqueoCaja->empresa_id = Auth::user()->empresa_id;

        $arqueoCaja->save();

        // REDIRECCIONAR AL INDEX DE CLIENTES //
        return redirect()->route('admin.arqueos.index')->with('mensaje', 'Arqueo de Caja actualizado con éxito')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ArqueoCaja::destroy($id);

        // REDIRECCIONAR AL INDEX DE ARQUEO_CAJAS //
        return redirect()->route('admin.arqueos.index')->with('mensaje', 'Arqueo de Caja eliminado con éxito')->with('icono', 'success');
    }
}
