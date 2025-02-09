@extends('adminlte::page')

@section('content_header')
    <h1><b>Asignar Permisos al Rol: {{$rol->name}}</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Permisos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form action="{{ route('admin.roles.store_asignar', $rol->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @foreach ($permisos as $modulo => $grupoPermisos)
                        <div class="col-md-4">
                            <h3>{{$modulo}}</h3>
                        @foreach ($grupoPermisos as $permiso)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permisos[]" id="permisos" value="{{ $permiso->id }}" {{$rol->hasPermissionTo($permiso->name) ? 'checked' : ''}}>
                                <label for="permisos" class="form-check-label">{{$permiso->name}}</label>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Asignar Permisos</button>
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