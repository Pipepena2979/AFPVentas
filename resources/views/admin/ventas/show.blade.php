@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas/Detalle de Venta</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Detalle de la Venta</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha Venta</label>
                                    <input type="date" class="form-control" value="{{ old('fecha', $venta->fecha) }}" name="fecha" disabled>
                                    @error('fecha')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente" value="{{ $venta->cliente->nombre_cliente ?? 'S/N' }}" disabled>
                                    <input type="hidden" name="id_cliente" id="id_cliente">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="nit_codigo">NIT/Código</label>
                                    <input type="text" class="form-control" id="nit_cliente" value="{{ $venta->cliente->nit_codigo ?? '0' }}" disabled>
                                    <input type="hidden" id="nit_codigo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover table-success table-striped-columns">
                            <thead>
                                <tr style="text-align: center;vertical-align: middle">
                                    <th>No.</th>
                                    <th>Código</th>
                                    <th>Cantidad</th>
                                    <th>Nombre</th>
                                    <th>Costo</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; $total_cantidad = 0; $total_venta = 0;?>
                                @foreach ($venta->detallesVenta as $detalle)
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->codigo }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->cantidad }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->nombre }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->precio_venta }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $total_producto = $detalle->cantidad * $detalle->producto->precio_venta }}</td>
                                    </tr>
                                    <?php 
                                    $total_cantidad += $detalle->cantidad;
                                    $total_venta += $total_producto;
                                    ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="text-align:right"><strong>Total Cantidad</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_cantidad }}</strong></td>
                                    <td colspan="2" style="text-align: right;"><strong>Total Venta</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_venta }}</strong></td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>                        
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="precio_venta">Total Venta</label>
                                    <input type="text" class="form-control" style="text-align: center; background-color: rgba(233, 231, 16, 0.15);font-weight: bold" value="{{ $total_venta }}" name="precio_venta" disabled>
                                    @error('precio_venta')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.ventas.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
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