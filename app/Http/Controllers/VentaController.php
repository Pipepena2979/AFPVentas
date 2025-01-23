<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\TmpVenta;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nnjeim\World\Models\Currency;
use NumberToWords\NumberToWords;
use NumberFormatter;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detallesVenta', 'cliente')->get();

        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // respuesta JSON de los datos del formulario //
        // $datosEmpresa = $request->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'fecha' => 'required',
            'precio_venta' => 'required|numeric', 
        ]);

        $session_id = session()->getId();

        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_venta; 
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->id_cliente;
        $venta->save();

        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        foreach($tmp_ventas as $tmp_venta) {
            
            $producto = Producto::where('id', $tmp_venta->producto_id)->first();
            
            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;
            $detalle_venta->save();

            $producto->stock -= $tmp_venta->cantidad;
            $producto->save();
        }

        TmpVenta::where('session_id', $session_id)->delete();

        // REDIRECCIONAR AL INDEX DE VENTAS //
        return redirect()->route('admin.ventas.index')->with('mensaje','Se ha registrado la venta exitosamente')->with('icono', 'success');
    }
    public function pdf($id) {

        function numeroAletrasConDecimales($numero) {
        
            $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
    
            // DIVIDIR EL NUMERO ENTRE LA PARTE ENTERA Y LA PARTE DECIMAL //
            $partes = explode('.', number_format($numero, 2, '.', ''));
    
            $entero = $formatter->format($partes[0]);
            $decimal = $formatter->format($partes[1]);
    
            return ucfirst("$entero con $decimal centavos");
        }

        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $id_empresa)->first();
        $moneda = Currency::where('symbol', $empresa->moneda)->first();
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);

        $numero = $venta->precio_total;
        $numero_a_letras = numeroAletrasConDecimales($numero);

        // echo $literal;
        
        $pdf = PDF::loadView('admin.ventas.pdf', compact('empresa', 'venta', 'moneda', 'numero_a_letras'));
        
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);

        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        return view('admin.ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Excluir los campos innecesarios y devolver la respuesta
        // $datosEmpresa = $request->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'fecha' => 'required',
            'precio_venta' => 'required|numeric', 
        ]);

        $venta = Venta::findOrFail($id);
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_venta; 
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->id_cliente;
        $venta->save();

        // REDIRECCIONAR AL INDEX DE COMPRAS //
        return redirect()->route('admin.ventas.index')->with('mensaje','Se ha actualizado la venta exitosamente')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        foreach($venta->detallesVenta as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $venta->detallesVenta()->delete();
        $venta->delete();


        // REDIRECCIONAR AL INDEX DE VENTAS //
        return redirect()->route('admin.ventas.index')->with('mensaje', 'Venta eliminada con éxito')->with('icono', 'success');
    }
}
