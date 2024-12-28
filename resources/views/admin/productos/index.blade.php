@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos/Listado de Productos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Productos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Crear Producto</a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="tabla_productos" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Categoría</th>
                                <th scope="col" class="text-center">Código</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Descripción</th>
                                <th scope="col" class="text-center">Stock</th>
                                <th scope="col" class="text-center">Precio Compra</th>
                                <th scope="col" class="text-center">Precio Venta</th>
                                <th scope="col" class="text-center">Imagen</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $producto->categoria->nombre }}</td>
                                    <td class="text-center">{{ $producto->codigo }}</td>
                                    <td class="text-center">{{ $producto->nombre }}</td>
                                    <td class="text-center">{{ $producto->descripcion }}</td>
                                    <td class="text-center" style="background-color: rgba(233, 231, 16, 0.15)">{{ $producto->stock }}</td>
                                    <td class="text-center">{{ $producto->precio_compra }}</td>
                                    <td class="text-center">{{ $producto->precio_venta }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="imagen producto">
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.productos.destroy', $producto->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $producto->id }} (event)" id="mi_formulario{{ $producto->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $producto->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar este Producto?",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $producto->id }}');
                                                                form.submit();
                                                                }
                                                            });
                                                        }
                                                </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
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
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    </script>
@stop