<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
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

        $pdf = Pdf::loadView('admin.roles.reporte', compact('roles', 'empresa'))->setPaper('letter', 'landscape');
        
        return $pdf->stream();
    }

    public function asignar($id) {

        $rol = Role::find($id);

        $permisos = Permission::all()->groupBy(function($permiso) {
            if (stripos($permiso->name, 'config') !== false) {
                return 'Configuración';
            }
            if (stripos($permiso->name, 'rol') !== false) {
                return 'Roles';
            }
            if (stripos($permiso->name, 'permi') !== false) {
                return 'Permisos';
            }
            if (stripos($permiso->name, 'usu') !== false) {
                return 'Usuarios';
            }
            if (stripos($permiso->name, 'cat') !== false) {
                return 'Categorías';
            }
            if (stripos($permiso->name, 'prod') !== false) {
                return 'Productos';
            }
            if (stripos($permiso->name, 'prov') !== false) {
                return 'Proveedores';
            }
            if (stripos($permiso->name, 'comp') !== false) {
                return 'Compras';
            }
            if (stripos($permiso->name, 'cli') !== false) {
                return 'Clientes';
            }
            if (stripos($permiso->name, 'ven') !== false) {
                return 'Ventas';
            }
            if (stripos($permiso->name, 'arq') !== false) {
                return 'Arqueos de Caja';
            }
        });

        return view('admin.roles.asignar', compact('rol', 'permisos'));
    }

    public function store_asignar(Request $request, $id) {

        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        $request->validate([
            'permisos' => 'required|array',
        ]);
        
        $rol = Role::find($id);
        $rol->permissions()->sync($request->input('permisos'));

        return redirect()->route('admin.roles.index')->with('mensaje', 'Permisos asignados al rol de la manera correcta')->with('icono', 'success');
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
