@extends('adminlte::page')

@section('content_header')
    <h1><b>Arqueos de Caja/Cierre del Arqueo de Caja</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.arqueos.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.arqueos.store_cierre')}}" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        <input type="text" name="id_arqueo" value="{{ $arqueoCaja->id }}" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_apertura">Fecha Apertura</label>
                                    <input type="dateTime-local" class="form-control" value="{{ $arqueoCaja->fecha_apertura }}" name="fecha_apertura" disabled>
                                    @error('fecha_apertura')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monto_inicial">Monto Inicial</label>
                                    <input type="text" class="form-control" value="{{ $arqueoCaja->monto_inicial }}" name="monto_inicial" disabled>
                                    @error('monto_inicial')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_cierre">Fecha Cierre</label>
                                    <input type="dateTime-local" class="form-control" value="{{ old('fecha_cierre') }}" name="fecha_cierre" required>
                                    @error('fecha_cierre')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monto_final">Monto Final</label>
                                    <input type="text" class="form-control" value="{{ old('monto_final') }}" name="monto_final" required>
                                    @error('monto_final')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Registrar</button>
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