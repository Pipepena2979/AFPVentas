<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        return view('admin.proveedores.index', compact('proveedores', 'empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
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
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required|unique:proveedors,nombre',
            'celular' => 'required',
        ]));

        $proveedor = new Proveedor();
        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;

        $proveedor->save();

        // REDIRECCIONAR AL INDEX DE PROVEEDORES //
        return redirect()->route('admin.proveedores.index')->with('mensaje','Se ha creado el Proveedor exitosamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);

        return view('admin.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        if($request->validate([
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required|unique:proveedors,nombre,'.$id,
            'celular' => 'required',
        ]));

        $proveedor = Proveedor::find($id);
        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;

        $proveedor->save();

        // REDIRECCIONAR AL INDEX DE PROVEEDORES //
        return redirect()->route('admin.proveedores.index')->with('mensaje','Proveedor actualizado con éxito')->with('icono', 'success');
    }

    public function reporte() {

        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $pdf = Pdf::loadView('admin.proveedores.reporte', compact('proveedores', 'empresa'))->setPaper('letter', 'landscape');
        
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);

        return redirect()->route('admin.proveedores.index')->with('mensaje', 'Proveedor eliminado con éxito')->with('icono', 'success');
    }
}
