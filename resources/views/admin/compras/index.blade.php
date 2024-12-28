@extends('adminlte::page')

@section('content_header')
    <h1><b>Compras/Historial de Compras</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Compras Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.compras.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Crear Compra</a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="tabla_compras" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Fecha</th>
                                <th scope="col" class="text-center">Comprobante</th>
                                <th scope="col" class="text-center">Precio Total</th>
                                <th scope="col" class="text-center">Productos</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($compras as $compra)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $compra->fecha }}</td>
                                    <td class="text-center">{{ $compra->comprobante }}</td>
                                    <td class="text-center">{{ $compra->precio_total }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($compra->detalles as $detalle)
                                                <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad.' Unidades' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.compras.show', $compra->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.compras.edit', $compra->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.compras.destroy', $compra->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $compra->id }} (event)" id="mi_formulario{{ $compra->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $compra->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar esta Compra?",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $compra->id }}');
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
        $('#tabla_compras').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Compras",
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