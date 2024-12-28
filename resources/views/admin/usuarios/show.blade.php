@extends('adminlte::page')

@section('content_header')
    <h1><b>Usuarios/Registrar Nuevo Usuario</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.store')}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rol">Nombre del Rol</label>
                                    <p>{{ $usuario->roles->pluck('name')->implode(', ') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre del Usuario</label>
                                    <p>{{ $usuario->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <p>{{ $usuario->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="created_at">Fecha y Hora de Creación</label>
                                    <p>{{ $usuario->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
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