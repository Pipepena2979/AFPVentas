<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa_id = Auth::user()->empresa_id;
        // SE OBTIENEN LOS USUARIOS CORRESPONDIENTES A LA EMPRESA //
        $usuarios = User::where('empresa_id', $empresa_id)->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // SE OBTIENEN TODOS LOS ROLES DE LA DB //
        $roles = Role::all();

        return view('admin.usuarios.create', compact('roles'));
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
            // 'rol' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password' => 'min:6',
        ],[
            'name' => 'El nombre es obligatorio',
            'email' => 'El correo es obligatorio',
            'password' => 'La contraseña debe tener al menos 6 caracteres',
            'password' => 'La contraseña es obligatoria',
            'password_confirmation' => 'Las contraseñas no coinciden',
        ]
    ));

        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->empresa_id = Auth::user()->empresa_id;

        $usuario->save();

        // ASIGNA EL ROL CORRESPONDIENTE AL USUARIO //
        $usuario->assignRole($request->rol);

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.usuarios.index')->with('mensaje','Se ha creado el usuario exitosamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);

        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('usuario', 'roles'));
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
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => $request->filled('password') ? 'confirmed|min:6' : '',
        ]));

        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        // METODO PARA CAMBIAR LA CONTRASEÑA DEL USUARIO, SI ES UNA CONTRASEÑA NUEVA, DE LO CONTRARIO SE MANTIENE EL MISMO PASSWORD //
        if($request->filled('password')) {
            $usuario->password = Hash::make($request->password);

        }
        $usuario->empresa_id = Auth::user()->empresa_id;

        $usuario->save();

        // MODIFICA EL ROL CORRESPONDIENTE AL USUARIO //
        $usuario->syncRoles($request->rol);

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.usuarios.index')->with('mensaje','Se ha actualizado el usuario exitosamente')->with('icono', 'success');
    }

    public function reporte() {
        
        $usuarios = User::all();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $pdf = Pdf::loadView('admin.usuarios.reporte', compact('usuarios', 'empresa'));
        
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('admin.usuarios.index')->with('mensaje', 'Usuario eliminado con éxito')->with('icono', 'success');
    }
}
