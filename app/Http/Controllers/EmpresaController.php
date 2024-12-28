<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('countries')->get();
        $departamentos = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();

        return view('admin.empresas.create', compact('paises', 'departamentos', 'ciudades', 'monedas'));
    }

    public function buscar_depto($id_pais) {

        try {
            $departamentos = DB::table('states')->where('country_id', $id_pais)->get();
            return view('admin.empresas.mostrar_deptos', compact('departamentos'));

        } catch (\Exception $exeption) {
            return response()->json(['mensaje'=>'Error']);
        }
    }

    public function buscar_cuidad($id_departamento) {
        try {
            $ciudades = DB::table('cities')->where('state_id', $id_departamento)->get();
            return view('admin.empresas.mostrar_ciudades', compact('ciudades'));

        } catch (\Exception $exeption) {
            return response()->json(['mensaje'=>'Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // INGRESAR LOS DATOS DE LA EMPRESA A TRAVÉS DEL METODO POST Y LA RESPUESTA DEBE SER UN JSON //
        // $datosEmpresa = request()->all();
        // return response()->json($datosEmpresa);
        // exit;

        // VALIDACIÓN DE LOS DATOS DE LA EMPRESA //
        if($request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas',
            'telefono' => 'required',
            'correo' => 'required|unique:empresas',
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,ico',
            'ciudad' => 'required|exists:cities,id',
        ],[
            'nombre_empresa' => 'El nombre de la empresa es obligatorio',
            'tipo_empresa' => 'El tipo de empresa es obligatorio',
            'nit' => 'El nit es obligatorio',
            'telefono' => 'El telefono es obligatorio',
            'correo' => 'El correo es obligatorio',
            'cantidad_impuesto' => 'La cantidad del impuesto es obligatorio',
            'nombre_impuesto' => 'El nombre del impuesto es obligatorio',
            'direccion' => 'La dirección es obligatoria',
            'logo' => 'El logo es obligatorio',
        ]));

        // GUARDAR LOS DATOS DE LA EMPRESA EN LA BASE DE DATOS //
        $empresa = new Empresa();
        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public');
        $empresa->save();

        // GUARDAR LOS DATOS DEL USUARIO(ADMIN) - (1 USUARIO POR DEFECTO POR CADA EMPRESA CREADA) EN LA BASE DE DATOS //
        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request->nit);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        $usuario->assignRole('ADMIN');

        // METODO PARA LOGEAR AL USUARIO DESPUES DE HABERSE REGISTRADO //
        FacadesAuth::login($usuario);

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.index')->with('mensaje','Se ha creado la empresa exitosamente')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $paises = DB::table('countries')->get();
        $departamentos = DB::table('states')->get();
        // $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        $empresa_id = FacadesAuth::user()->empresa_id;
        $empresa = Empresa::where('id', $empresa_id)->first();
        $cantidad_departamentos = DB::table('states')->where('country_id', $empresa->pais)->get();
        $ciudades = DB::table('cities')->where('state_id', $empresa->departamento)->get();

        return view('admin.configuraciones.edit', compact('paises', 'departamentos', 'ciudades', 'monedas', 'empresa','cantidad_departamentos'));
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
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas,nit,'.$id,
            'telefono' => 'required',
            'correo' => 'required|unique:empresas,correo,'.$id,
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required|exists:cities,id',
        ],[
            'nombre_empresa' => 'El nombre de la empresa es obligatorio',
            'tipo_empresa' => 'El tipo de empresa es obligatorio',
            'nit' => 'El nit es obligatorio',
            'telefono' => 'El telefono es obligatorio',
            'correo' => 'El correo es obligatorio',
            'cantidad_impuesto' => 'La cantidad del impuesto es obligatorio',
            'nombre_impuesto' => 'El nombre del impuesto es obligatorio',
            'direccion' => 'La dirección es obligatoria',
        ]));

        $empresa = Empresa::find($id);

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        if($request->hasFile('logo')) {
            Storage::delete('public/'.$empresa->logo);
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }
        $empresa->save();

        $usuario_id = FacadesAuth::user()->id;
        
        $usuario = User::find($usuario_id);
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request->nit);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        // REDIRECCIONAR AL INDEX DEL ADMIN //
        return redirect()->route('admin.index')->with('mensaje','Se actualizaron correctamente los datos de la empresa')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
