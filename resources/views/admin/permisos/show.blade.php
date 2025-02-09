@extends('adminlte::page')

@section('content_header')
    <h1><b>Permisos/Detalle del Permiso</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Permiso</label>
                                    <input type="text" class="form-control" value="{{ $permiso->name }}" disabled>
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            <div class="form-group">
                                    <label for="name">Fecha y Hora de Creación</label>
                                    <input type="text" class="form-control" value="{{ $permiso->created_at }}" disabled>
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
                                <a href="{{ route('admin.permisos.index')}}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
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