@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras/Editar Compra</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.compras.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.compras.update', $compra->id)}}" id= "form_compra" method="POST">
                        {{-- Token de Seguridad --}}
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_compra" value="{{ $compra->id }}" id="id_compra">
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
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha">Fecha Compra</label>
                                    <input type="date" class="form-control" value="{{ $compra->fecha }}" name="fecha">
                                    @error('fecha')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="comprobante">Comprobante</label>
                                    <input type="text" class="form-control" value="{{ $compra->comprobante }}" name="comprobante">
                                    @error('comprobante')
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
                                <?php $contador = 1; $total_cantidad = 0; $total_compra = 0;?>
                                @foreach ($compra->detalles as $detalle)
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->codigo }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->cantidad }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->nombre }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $detalle->producto->precio_compra }}</td>
                                        <td style="text-align: center;vertical-align: middle">{{ $total_producto = $detalle->cantidad * $detalle->producto->precio_compra }}</td>
                                        <td style="text-align: center;vertical-align: middle">
                                            <button type="button" class="btn btn-danger align-center delete-btn" data-id="{{ $detalle->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php 
                                    $total_cantidad += $detalle->cantidad;
                                    $total_compra += $total_producto;
                                    ?>
                                @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="2" style="text-align:right"><strong>Total Cantidad</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_cantidad }}</strong></td>
                                    <td colspan="2" style="text-align: right;"><strong>Total Compra</strong></td>
                                    <td style="text-align: center;vertical-align: middle"><strong>{{ $total_compra }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfooter>
                        </table>
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_compra">Total Compra</label>
                                    <input type="text" class="form-control" style="text-align: center; background-color: rgba(233, 231, 16, 0.15);" value="{{ $total_compra }}" name="precio_compra" readonly>
                                    @error('precio_compra')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar-proveedor"><i class="fas fa-search"></i> Buscar Proveedor</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-buscar-proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Listado de Proveedores</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <table id="tabla_proveedores" class="table table-hover table-success table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No.</th>
                                                            <th class="text-center">Acción</th>
                                                            <th class="text-center">Empresa</th>
                                                            <th class="text-center">Nombre del Proveedor</th>
                                                            <th class="text-center">Celular del Proveedor</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php $contador = 1; ?>
                                                            @foreach ($proveedores as $proveedor)
                                                                <tr>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $contador++ }}</td>
                                                                    <td style="text-align: center;vertical-align: middle"><button type="button" class="btn btn-primary select-btn-proveedor" data-id="{{ $proveedor->id }}" data-empresa="{{ $proveedor->empresa}}">Seleccionar</button></td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $proveedor->empresa }}</td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $proveedor->nombre }}</td>
                                                                    <td style="text-align: center;vertical-align: middle">{{ $proveedor->celular }}</td>
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                    <input type="text" class="form-control" value="{{ $compra->proveedor->empresa }}" id="empresa_proveedor" disabled>
                                    <input type="text" class="form-control" name="id_proveedor" value="{{ $compra->proveedor->id }}" id="id_proveedor" hidden>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Actualizar Compra</button>
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
                    url: "{{ url('admin/compras/detalle')}}/"+id,
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
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
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
                var id_compra = $('#id_compra').val();
                var id_proveedor = $('#id_proveedor').val();
                
                if(codigo.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.compras.detalle.store') }}",
                        method: 'POST',
                        data: {
                            _token:'{{ csrf_token() }}',
                            codigo: codigo,
                            cantidad: cantidad,
                            id_compra: id_compra,
                            id_proveedor: id_proveedor
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
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
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