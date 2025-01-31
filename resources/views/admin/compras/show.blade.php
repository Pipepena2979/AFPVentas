@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras/Detalle de Compra</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Detalle de la Compra</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha Compra</label>
                                    <input type="date" class="form-control" value="{{ $compra->fecha }}" name="fecha" disabled>
                                    @error('fecha')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="comprobante">Comprobante</label>
                                    <input type="text" class="form-control" value="{{ $compra->comprobante }}" name="comprobante" disabled>
                                    @error('comprobante')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" class="form-control" value="{{ $compra->proveedor->nombre }}" name="id_proveedor" id="id_proveedor" disabled>
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
                                <?php $contador = 1; $total_cantidad = 0; $total_compra = 0;?>
                                @foreach ($compra->detalles as $detalle)
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->codigo }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->cantidad }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->nombre }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->precio_compra }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $total_producto = $detalle->cantidad * $detalle->producto->precio_compra }}</td>
                                    </tr>
                                    <?php 
                                    $total_cantidad += $detalle->cantidad;
                                    $total_compra += $total_producto;
                                    ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="text-align:right"><strong>Total Cantidad</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_cantidad }}</strong></td>
                                    <td colspan="2" style="text-align: right;"><strong>Total Compra</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_compra }}</strong></td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>                        
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="precio_compra">Total Compra</label>
                                    <input type="text" class="form-control" style="text-align: center; background-color: rgba(233, 231, 16, 0.15);font-weight: bold" value="{{ $total_compra }}" name="precio_compra" disabled>
                                    @error('precio_compra')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.compras.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
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