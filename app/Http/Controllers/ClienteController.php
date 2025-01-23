<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'nombre_cliente' => 'required|unique:clientes',
            'nit_codigo' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $cliente = new Cliente();

        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;

        $cliente->save();

        // REDIRECCIONAR AL INDEX DE CLIENTES //
        return redirect()->route('admin.clientes.index')->with('mensaje', 'Cliente creado con éxito')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('admin.clientes.edit', compact('cliente'));
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
            'nombre_cliente' => 'required|unique:clientes,nombre_cliente,'.$id,
            'nit_codigo' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $cliente = Cliente::find($id);

        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;

        $cliente->save();

        // REDIRECCIONAR AL INDEX DE CLIENTES //
        return redirect()->route('admin.clientes.index')->with('mensaje', 'Cliente actualizado con éxito')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        // REDIRECCIONAR AL INDEX DE CLIENTES //
        return redirect()->route('admin.clientes.index')->with('mensaje', 'Cliente eliminado con éxito')->with('icono', 'success');
    }
}
