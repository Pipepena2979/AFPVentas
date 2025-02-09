<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function index() {

        $permisos = Permission::all();

        return view('admin.permisos.index', compact('permisos'));
    }

    public function create() {

        return view('admin.permisos.create');
    }

    public function store(Request $request) {

        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create(['name'=>$request->name]);

        return redirect()->route('admin.permisos.index')->with('mensaje', 'Permiso creado con éxito')->with('icono', 'success');
    }

    public function show($id) {

        $permiso = Permission::findOrFail($id);

        return view('admin.permisos.show', compact('permiso'));
    }

    public function edit($id) {
        
        $permiso = Permission::findOrFail($id);

        return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, $id) {

        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;
        
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
        ]);

        $permiso = Permission::find($id);
        $permiso->update(['name'=>$request->name]);

        return redirect()->route('admin.permisos.index')->with('mensaje', 'Permiso actualizado con éxito')->with('icono', 'success');
    }

    public function destroy($id) {

        $permiso = Permission::find($id);
        $permiso->delete();

        return redirect()->route('admin.permisos.index')->with('mensaje', 'Permiso eliminado con éxito')->with('icono', 'success');
    }
}
