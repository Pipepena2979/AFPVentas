<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|unique:roles',
        ]);

        $rol = new Role();

        $rol->name = $request->name;
        $rol->guard_name = 'web';

        $rol->save();

        return redirect()->route('admin.roles.index')->with('mensaje', 'Rol creado con éxito')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = Role::find($id);

        return view('admin.roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Role::find($id);

        return view('admin.roles.edit', compact('rol'));
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
            'name' => 'required|unique:roles',
        ]);

        $rol = Role::find($id);

        $rol->name = $request->name;
        $rol->guard_name = 'web';

        $rol->save();

        return redirect()->route('admin.roles.index')->with('mensaje', 'Rol actualizado con éxito')->with('icono', 'success');
    }

    public function reporte() {

        $roles = Role::all();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $pdf = Pdf::loadView('admin.roles.reporte', compact('roles', 'empresa'));
        
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return redirect()->route('admin.roles.index')->with('mensaje', 'Rol eliminado con éxito')->with('icono', 'success');
    }
}
