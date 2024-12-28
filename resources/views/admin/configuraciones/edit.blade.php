@extends('adminlte::page')

@section('content_header')
    <h1><b>Configuraciones/Editar</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- Card Box --}}
        <div class="card card-outline card-success">

            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none">
                    <b>Editar Datos de la Empresa</b>
                </h3>
            </div>

    {{-- Card Body --}}
    <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
        <form action="{{ route('admin.configuracion.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
            {{-- <-- TOKEN DE SEGURIDAD DE LARAVEL, INSDISPENSABLE EN LOS FURMULARIOS PARA LOS METODOS POST --> --}}
            @csrf
            @method('PUT')
            <div class="container">
                <form>
                    <div class="row">
                        <!-- Primera Columna para el Logo -->
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" id="file" name="logo" accept="image/*" class="form-control">
                                @error('logo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <center>
                                    <output id="list">
                                        <img src="{{ asset('storage/'.$empresa->logo) }}" width="100%" alt="logo">
                                    </output>
                                </center>
                                <script>
                                    // Tu código de JavaScript permanece igual
                                </script>
                            </div>
                        </div>
            
                        <!-- Segunda Columna con otros campos distribuidos en 3 filas -->
                        <div class="col-md-8 col-sm-12">
                            <div class="row">
                                <!-- Primera fila -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select name="pais" id="pais" class="form-control">
                                            <option value="" disabled selected>Seleccione un País</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" {{ $empresa->pais == $pais->id ? 'selected' : ''}}>{{ $pais->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <div class="form-group">
                                        <label for="departamento">Departamento</label>
                                        <select name="departamento" id="deptos_edit" class="form-control">
                                            <option value="" disabled selected>Seleccione un Departamento</option>
                                            @foreach ($cantidad_departamentos as $departamento)
                                            <option value="{{ $departamento->id }}" {{ $empresa->departamento == $departamento->id ? 'selected' : ''}}>{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_pais"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad/Muni</label>
                                        <select name="ciudad" id="ciudades_edit" class="form-control">
                                            <option value="" disabled selected>Ciudad/Muni</option>
                                            @foreach ($ciudades as $ciudad)
                                            <option value="{{ $ciudad->id }}" {{ $empresa->ciudad == $ciudad->id ? 'selected' : ''}}>{{ $ciudad->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_depto"></div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <!-- Segunda fila -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de la Empresa</label>
                                        <input type="text" name="nombre_empresa" value="{{ $empresa->nombre_empresa }}" class="form-control" required>
                                        @error('nombre_empresa')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="tipo_empresa">Tipo de Empresa</label>
                                        <input type="text" name="tipo_empresa" value="{{ $empresa->tipo_empresa }}" class="form-control" required>
                                        @error('tipo_empresa')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="nit">NIT</label>
                                        <input type="text" name="nit" value="{{ $empresa->nit }}" class="form-control" required>
                                        @error('nit')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <!-- Tercera fila -->
                                <div class="col-md-5 col-sm-6">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option value="" disabled selected>Seleccione la Moneda de su País</option>
                                            @foreach ($monedas as $moneda)
                                            <option value="{{ $moneda->symbol }}" {{ $empresa->moneda == $moneda->symbol ? 'selected' : ''}}>{{ $moneda->symbol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="nombre_impuesto">Nombre del Impuesto</label>
                                        <input type="text" name="nombre_impuesto" value="{{ $empresa->nombre_impuesto }}" class="form-control" required>
                                        @error('nombre_impuesto')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="cantidad_impuesto">Cantidad de Impuesto</label>
                                        <input type="number" name="cantidad_impuesto" value="{{ $empresa->cantidad_impuesto }}" class="form-control" required>
                                        @error('cantidad_impuesto')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <!-- Cuarta fila -->
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="codigo_postal">Prefijo Telefónico del País</label>
                                        <select name="codigo_postal" id="codigo_postal" class="form-control">
                                            <option value="" disabled selected>Seleccione el Prefijo Telefónico de su País</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{ $pais->phone_code }}" {{ $empresa->codigo_postal == $pais->phone_code ? 'selected' : ''}}>{{ $pais->phone_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" value="{{ $empresa->telefono }}" class="form-control" required>
                                        @error('telefono')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="correo">Correo de la Empresa</label>
                                        <input type="email" name="correo" value="{{ $empresa->correo }}" class="form-control" required>
                                        @error('correo')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <!-- Quinta fila -->
                                <div class="col-md-11 col-sm-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input id="pac-input" class="form-control" name="direccion" value="{{ $empresa->direccion }}" type="text" placeholder="Buscar..." required>
                                        @error('direccion')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
            
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <button type="submit" class="btn btn-success btn-block">Actualizar Datos</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>            
@stop

@section('css')
@stop

@section('js')
    {{-- <-- SCRIPT PARA OBTENER LOS DEPARTAMENTOS A PARTIR DEL PAIS CON AJAX  --> --}}
        <script>
            $('#pais').on('change', function() {
                var id_pais = $('#pais').val();
                // alert(pais);

                if(id_pais) {
                    $.ajax({
                        url: "{{ url('/admin/configuracion/pais/')}}"+'/'+id_pais,
                        type: "GET",
                        success: function(data) {
                            $('#deptos_edit').css('display', 'none');
                            $('#respuesta_pais').html(data);
                        }
                    });
                } else {
                    alert('Debe Seleccionar un País');
                }
            });
        </script>

        {{-- <-- SCRIPT PARA OBTENER LAS CIUDADES A PARTIR DE LOS DEPARTAMENTOS CON AJAX  --> --}}
        
        <script>
            $(document).on('change', '#deptos', function() {
                var id_departamento = $(this).val();
                // alert(id_departamento);

                if(id_departamento) {
                    $.ajax({
                        url: "{{ url('/admin/configuracion/depto/')}}"+'/'+ id_departamento,
                        type: "GET",
                        success: function(data) {
                            $('#ciudades_edit').css('display', 'none');
                            $('#respuesta_depto').html(data);
                        }
                    });
                } else {
                    alert('Debe Seleccionar un Departamento');
                }
            });
        </script>
@stop