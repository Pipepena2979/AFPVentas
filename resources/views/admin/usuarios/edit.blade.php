@extends('adminlte::page')

@section('content_header')
    <h1><b>Usuarios/Editar Usuario</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rol">Nombre del Rol</label>
                                    <select name="rol" id="" class="form-control">
                                        <option value="" disabled selected>Seleccione un Rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $role->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre del Usuario</label>
                                    <input type="text" class="form-control" value="{{ $usuario->name }}" name="name" required>
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" value="{{ $usuario->email }}" name="email" required>
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Nuevo Password</label>
                                    <input type="password" class="form-control" value="{{ old('password') }}" name="password">
                                    @error('password')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Repita el Password</label>
                                    <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation">
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