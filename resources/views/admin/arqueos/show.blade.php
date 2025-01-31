@extends('adminlte::page')

@section('content_header')
    <h1><b>Arqueos de Caja/Detalle del Arqueo de Caja</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_apertura">Fecha de Apertura</label>
                                    <input type="dateTime-local" class="form-control" value="{{ $arqueoCaja->fecha_apertura }}" name="fecha_apertura" disabled="disabled">
                                    @error('fecha_apertura')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto_inicial">Monto Inicial</label>
                                <input type="text" class="form-control" value="{{ $arqueoCaja->monto_inicial ?? '0' }}" name="monto_inicial" disabled>
                                @error('monto_inicial')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_cierre">Fecha de Cierre</label>
                                    <input type="dateTime-local" class="form-control" value="{{ $arqueoCaja->fecha_cierre }}" name="fecha_cierre" disabled="disabled">
                                    @error('fecha_cierre')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monto_final">Monto Final</label>
                                <input type="text" class="form-control" value="{{ $arqueoCaja->monto_final ?? 'NO SE HA CERRADO LA CAJA' }}" name="monto_final" disabled>
                                @error('monto_final')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" class="form-control" value="{{ $arqueoCaja->observaciones ?? 'S/OBSERVACIONES' }}" name="observaciones" disabled>
                                @error('observaciones')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Ingresos</h3>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-success table-striped-columns">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Nro</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; $suma_monto_ingresos = 0; ?>
                                @foreach ($movimientos as $movimiento)
                                @if ($movimiento->tipo == 'INGRESO')
                                @php
                                    $suma_monto_ingresos += $movimiento->monto;
                                @endphp
                                    <tr class="text-center">
                                        <td>{{ $contador++ }}</td>
                                        <td>{{ $movimiento->descripcion ?? 'NO HAN HABIDO INGRESOS' }}</td>
                                        <td>{{ $movimiento->monto ?? 'NO HAN HABIDO INGRESOS' }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="text-align:right"><b>Total:</b></td>
                                    <td class="text-center">{{ $suma_monto_ingresos ?? 'NO HAN HABIDO INGRESOS' }}</td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Egresos</h3>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-success table-striped-columns">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nro</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 1; $suma_monto_egresos = 0; ?>
                                    @foreach ($movimientos as $movimiento)
                                    @if ($movimiento->tipo == 'EGRESO')
                                    @php
                                        $suma_monto_egresos += $movimiento->monto;
                                    @endphp
                                        <tr class="text-center">
                                            <td>{{ $contador++ }}</td>
                                            <td>{{ $movimiento->descripcion ?? 'NO HAN HABIDO EGRESOS' }}</td>
                                            <td>{{ $movimiento->monto ?? 'NO HAN HABIDO EGRESOS' }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align:right"><b>Total:</b></td>
                                        <td class="text-center">{{ $suma_monto_egresos ?? 'NO HAN HABIDO EGRESOS' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <a href="{{ route('admin.arqueos.index')}}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>
        </div>
    </div>
@stop
@section('css')
@stop

@section('js')
@stop