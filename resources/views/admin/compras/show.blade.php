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
    <script>

        $('.select-btn').on('click', function () {
            var id_producto = $(this).data('id');
            $('#codigo').val(id_producto);
            $('#modal-buscar').modal('hide');
            $('#modal-buscar').on('hidden.bs.modal', function () {
                $('#codigo').focus();
            })
        });

        $('.select-btn-proveedor').on('click', function () {
            var id_proveedor = $(this).data('id');
            var empresa = $(this).data('empresa');
            $('#id_proveedor').val(id_proveedor);
            $('#empresa_proveedor').val(empresa);
            $('#modal-buscar-proveedor').modal('hide');
        });

        $('.delete-btn').on('click', function () {
            var id = $(this).data('id');
            if(id) {
                $.ajax({
                    url: "{{ route('admin.compras.tmp_compras')}}/"+id,
                    type: 'POST',
                    data: {
                        _token:'{{csrf_token()}}',
                        _method: 'DELETE',
                    },
                    success:function (response) {
                        if(response.success) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "El Producto fue Eliminado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Error al Agregar el Producto",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error:function (error) {
                            alert(error);
                        }
                    });
                }
            });
        

        $('#codigo').focus()
        $('#form_compra').on('keypress', function (e) {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        });

        $('#codigo').on('keyup', function (e) {
            if(e.which === 13) {
                var codigo = $(this).val();
                var cantidad = $('#cantidad').val();
                
                if(codigo.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.compras.tmp_compras')}}",
                        method: 'POST',
                        data: {
                            _token:'{{csrf_token()}}',
                            codigo: codigo,
                            cantidad: cantidad
                        },
                        success:function (response) {
                            if(response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "El Producto fue Agregado",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Error al Agregar el Producto",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error:function (error) {
                            alert(error);
                        }
                    });
                }
            }
        });
    </script>
    <script>
        $('#modal-buscar').on('shown.bs.modal', function () {
        $('#tabla_productos').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
            });
        });

        $('#modal-buscar-proveedor').on('shown.bs.modal', function () {
        $('#tabla_proveedores').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
            });
        });
    </script>
@stop