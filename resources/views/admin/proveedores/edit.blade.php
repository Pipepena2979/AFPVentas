@extends('adminlte::page')

@section('content_header')
    <h1><b>Proveedores/Editar Proveedor</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.proveedores.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.proveedores.update', $proveedor->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empresa">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" value="{{ $proveedor->empresa }}" name="empresa" required>
                                    @error('empresa')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección de la Empresa</label>
                                    <input type="text" class="form-control" value="{{ $proveedor->direccion }}" name="direccion" required>
                                    @error('direccion')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono de la Empresa</label>
                                    <input type="text" class="form-control" value="{{ $proveedor->telefono }}" name="telefono" required>
                                    @error('telefono')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo de la Empresa</label>
                                    <input type="email" class="form-control" value="{{ $proveedor->email }}" name="email" required>
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Proveedor</label>
                                    <input type="text" class="form-control" value="{{ $proveedor->nombre }}" name="nombre" required>
                                    @error('nombre')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">Celular del Proveedor</label>
                                    <input type="text" class="form-control" value="{{ $proveedor->celular }}" name="celular" required>
                                    @error('celular')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Editar</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop