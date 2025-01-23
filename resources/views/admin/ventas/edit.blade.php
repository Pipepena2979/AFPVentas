@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas/Editar Venta</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ventas.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ventas.update', $venta->id)}}" id= "form_venta" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_venta" value="{{ $venta->id }}" id="id_venta">
                        <div class="row">
                        <div class="col-md-1">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" style="text-align: center;background-color: rgba(233, 231, 16, 0.15)" class="form-control" id="cantidad" value="1" name="cantidad" required>
                                    @error('cantidad')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="codigo">Código</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" id="codigo" name="codigo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar"><i class="fas fa-search"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-buscar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de Productos</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                <div class="modal-body">
                                                    <table id="tabla_productos" class="table table-hover table-success table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No.</th>
                                                                <th class="text-center">Acción</th>
                                                                <th class="text-center">Categoría</th>
                                                                <th class="text-center">Código</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Descripción</th>
                                                                <th class="text-center">Stock</th>
                                                                <th class="text-center">Precio Compra</th>
                                                                <th class="text-center">Precio Venta</th>
                                                                <th class="text-center">Imagen</th>
                                                            </tr>
                                                        </thead>
                                                            <tbody>
                                                                <?php $contador = 1; ?>
                                                                @foreach ($productos as $producto)
                                                                    <tr>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                                                        <td style="text-align: center;vertical-align: middle"><button type="button" class="btn btn-primary select-btn" data-id="{{ $producto->codigo }}">Seleccionar</button></td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->categoria->nombre }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->codigo }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->nombre }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->descripcion }}</td>
                                                                        <td style="text-align: center;vertical-align: middle" style="background-color: rgba(233, 231, 16, 0.15)">{{ $producto->stock }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->precio_compra }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">{{ $producto->precio_venta }}</td>
                                                                        <td style="text-align: center;vertical-align: middle">
                                                                            <img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="imagen producto">
                                                                        </td>
                                                                    </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.productos.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha Venta</label>
                                    <input type="date" class="form-control" value="{{ $venta->fecha }}" name="fecha">
                                    @error('fecha')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
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
                                    <th>Acción</th>
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
                                        <td style="text-align: center;vertical-align: middle">
                                            <button type="button" class="btn btn-danger align-center delete-btn" data-id="{{ $detalle->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php 
                                    $total_cantidad += $detalle->cantidad;
                                    $total_venta += $total_producto;
                                    ?>
                                @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="2" style="text-align:right"><strong>Total Cantidad</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_cantidad }}</strong></td>
                                    <td colspan="2" style="text-align: right;"><strong>Total Venta</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_venta }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfooter>
                        </table>
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_venta">Total Venta</label>
                                    <input type="text" class="form-control" style="text-align: center; background-color: rgba(233, 231, 16, 0.15);" value="{{ $total_venta }}" name="precio_venta" readonly>
                                    @error('precio_venta')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar-cliente"><i class="fas fa-search"></i> Buscar Cliente</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-buscar-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Listado de Clientes</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <table id="tabla_clientes" class="table table-hover table-success table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No.</th>
                                                            <th class="text-center">Acción</th>
                                                            <th class="text-center">Nombre del Cliente</th>
                                                            <th class="text-center">NIT/Código del Cliente</th>
                                                            <th class="text-center">Teléfono</th>
                                                            <th class="text-center">Email</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php $contador = 1; ?>
                                                            @foreach ($clientes as $cliente)
                                                                <tr>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                                                    <td style="text-align: center;vertical-align: middle"><button type="button" class="btn btn-primary select-btn-cliente" data-id="{{ $cliente->id }}" data-nombre_cliente="{{ $cliente->nombre_cliente }} " data-nit_cliente="{{ $cliente->nit_codigo }} " data-telefono_cliente="{{ $cliente->telefono }} " data-email_cliente="{{ $cliente->email }}">Seleccionar</button></td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $cliente->nombre_cliente }}</td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $cliente->nit_codigo }}</td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $cliente->telefono }}</td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $cliente->email }}</td>
                                                                </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>                                        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente" value="{{ $venta->cliente->nombre_cliente ?? 'S/N' }}" disabled>
                                    <input type="hidden" name="id_cliente" id="id_cliente">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                    <label for="nit_codigo">NIT/Código</label>
                                    <input type="text" class="form-control" id="nit_cliente" value="{{ $venta->cliente->nit_codigo ?? '0' }}" disabled>
                                    <input type="hidden" id="nit_codigo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono_cliente" value="{{ $venta->cliente->telefono ?? '0' }}" disabled>
                                    <input type="hidden" id="telefono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email_cliente" value="{{ $venta->cliente->email ?? 'S/E' }}" disabled>
                                    <input type="hidden" id="email">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Actualizar Venta</button>
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
    <script>

        $('.select-btn').on('click', function () {
            var id_producto = $(this).data('id');
            $('#codigo').val(id_producto);
            $('#modal-buscar').modal('hide');
            $('#modal-buscar').on('hidden.bs.modal', function () {
                $('#codigo').focus();
            })
        });

        $('.select-btn-cliente').on('click', function () {
            var id_cliente = $(this).data('id');
            var nombre_cliente = $(this).data('nombre_cliente');
            var nit_cliente = $(this).data('nit_cliente');
            var telefono_cliente = $(this).data('telefono_cliente');
            var email_cliente = $(this).data('email_cliente');
            $('#id_cliente').val(id_cliente);
            $('#nombre_cliente').val(nombre_cliente);
            $('#nit_cliente').val(nit_cliente);
            $('#telefono_cliente').val(telefono_cliente);
            $('#email_cliente').val(email_cliente);
            $('#modal-buscar-cliente').modal('hide');
        });

        $('.delete-btn').on('click', function () {
            var id = $(this).data('id');
            if(id) {
                $.ajax({
                    url: "{{ url('admin/ventas/detalle')}}/"+id,
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
        $('#form_venta').on('keypress', function (e) {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        });

        $('#codigo').on('keyup', function (e) {
            if(e.which === 13) {
                var codigo = $(this).val();
                var cantidad = $('#cantidad').val();
                var id_venta = '{{ $venta->id }}';
                
                if(codigo.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.ventas.detalle.store') }}",
                        method: 'POST',
                        data: {
                            _token:'{{csrf_token()}}',
                            codigo: codigo,
                            cantidad: cantidad,
                            id_venta: id_venta
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

        $('#modal-buscar-cliente').on('shown.bs.modal', function () {
        $('#tabla_clientes').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
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