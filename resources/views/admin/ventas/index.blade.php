@extends('adminlte::page')

@section('content_header')
    <h1><b>Ventas/Historial de Ventas</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ventas Registradas</h3>
                    <div class="card-tools">
                        @if($arqueoAbierto)
                            <a href="{{ route('admin.ventas.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Crear Venta</a>
                        @else
                            <a href="{{ route('admin.arqueos.create') }}" class="btn btn-danger"><i class="fas fa-cash-register"></i> Abrir Caja</a>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="table-responsive">
                        <table id="tabla_ventas" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Fecha</th>
                                <th scope="col" class="text-center">Precio Total</th>
                                <th scope="col" class="text-center">Productos</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $venta->fecha }}</td>
                                    <td class="text-center">{{ $venta->precio_total }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($venta->detallesVenta as $detalle)
                                                <li>{{ $detalle->producto->nombre }} - {{ $detalle->cantidad.' Unidades' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.ventas.show', $venta->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.ventas.edit', $venta->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.ventas.pdf', $venta->id) }}" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-file-pdf"></i></a>
                                                <form action="{{ route('admin.ventas.destroy', $venta->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $venta->id }} (event)" id="mi_formulario{{ $venta->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $venta->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar esta Venta?",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $venta->id }}');
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
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $('#tabla_ventas').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Ventas",
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