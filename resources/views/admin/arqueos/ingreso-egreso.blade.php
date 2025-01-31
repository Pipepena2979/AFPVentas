@extends('adminlte::page')

@section('content_header')
    <h1><b>Arqueos de Caja/Registrar Ingresos/Egresos</b></h1>
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
                    <form action="{{ route('admin.arqueos.store_ingreso_egreso')}}" method="POST">
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
                                    <label for="tipo">Tipo Movimiento</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="" disabled selected>Seleccione una Opción</option>
                                        <option value="INGRESO">INGRESO</option>
                                        <option value="EGRESO">EGRESO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monto">Monto</label>
                                    <input type="text" class="form-control" value="{{ old('monto') }}" name="monto" required>
                                    @error('monto')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" value="{{ old('descripcion') }}" name="descripcion">
                                    @error('descripcion')
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