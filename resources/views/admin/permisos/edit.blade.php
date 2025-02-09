@extends('adminlte::page')

@section('content_header')
    <h1><b>Permisos/Editar Permiso</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Actualice los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.permisos.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.permisos.update', $permiso->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Permiso</label>
                                    <input type="text" class="form-control" value="{{ $permiso->name }}" name="name" required>
                                    @error('name')
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