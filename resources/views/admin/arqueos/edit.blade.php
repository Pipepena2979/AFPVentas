@extends('adminlte::page')

@section('content_header')
    <h1><b>Arqueos de Caja/Editar Arqueo de Caja</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Actualice los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.arqueos.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.arqueos.update', $arqueoCaja->id)}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_apertura">Fecha de Apertura</label>
                                    <input type="dateTime-local" class="form-control" value="{{ $arqueoCaja->fecha_apertura }}" name="fecha_apertura" required>
                                    @error('fecha_apertura')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto_inicial">Monto Inicial</label>
                                <input type="text" class="form-control" value="{{ $arqueoCaja->monto_inicial ?? '0' }}" name="monto_inicial">
                                @error('monto_inicial')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" class="form-control" value="{{ $arqueoCaja->observaciones ?? 'S/OBSERVACIONES' }}" name="observaciones">
                                @error('observaciones')
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