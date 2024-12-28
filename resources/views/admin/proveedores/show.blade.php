@extends('adminlte::page')

@section('content_header')
    <h1><b>Proveedores/Proveedor Registrado</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empresa">Nombre de la Empresa</label>
                                    <p>{{ $proveedor->empresa }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección de la Empresa</label>
                                    <p>{{ $proveedor->direccion }}</p>
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono de la Empresa</label>
                                    <p>{{ $proveedor->telefono }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo de la Empresa</label>
                                    <p>{{ $proveedor->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Proveedor</label>
                                    <p>{{ $proveedor->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular del Proveedor</label>
                                    <p>{{ $proveedor->celular }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.proveedores.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop