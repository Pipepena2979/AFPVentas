@extends('adminlte::page')

@section('content_header')
    <h1><b>Clientes/Editar Cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Actualice los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.clientes.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.clientes.update', $cliente->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" class="form-control" value="{{ $cliente->nombre_cliente }}" name="nombre_cliente" required>
                                    @error('nombre_cliente')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nit_codigo">MIT/Código del Cliente</label>
                                    <input type="text" class="form-control" value="{{ $cliente->nit_codigo }}" name="nit_codigo" required>
                                    @error('nit_codigo')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" value="{{ $cliente->telefono }}" name="telefono" required>
                                    @error('telefono')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ $cliente->email }}" name="email" required>
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-edit"></i> Editar</button>
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