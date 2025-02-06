@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Arqueos de Caja</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Arqueos de Caja Registrados</h3>
                    <div class="card-tools">
                        @if($arqueoAbierto)
                            <a href="{{ route('admin.arqueos.reporte') }}" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Reporte</a>
                            <a href="{{ route('admin.arqueos.cierre', $arqueos->last()->id) }}" class="btn btn-success"><i class="fas fa-lock"></i> Cerrar Caja</a>
                        @else
                            <a href="{{ route('admin.arqueos.reporte') }}" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Reporte</a>
                            <a href="{{ route('admin.arqueos.create') }}" class="btn btn-danger"><i class="fas fa-plus"></i> Crear Arqueo de Caja</a>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="table-responsive">
                        <table id="tabla_arqueos" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Fecha de Apertura</th>
                                <th scope="col" class="text-center">Monto Inicial</th>
                                <th scope="col" class="text-center">Fecha de Cierre</th>
                                <th scope="col" class="text-center">Monto Final</th>
                                <th scope="col" class="text-center">Observaciones</th>
                                <th scope="col" class="text-center">Movimientos</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($arqueos as $arqueo)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $arqueo->fecha_apertura }}</td>
                                    <td class="text-center">{{ $arqueo->monto_inicial }}</td>
                                    <td class="text-center">{{ $arqueo->fecha_cierre }}</td>
                                    <td class="text-center">{{ $arqueo->monto_final }}</td>
                                    <td class="text-center">{{ $arqueo->observaciones }}</td>
                                    <td class="text-center">
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-md-8 text-center">
                                                <b>Ingresos:</b> <br>
                                                {{ number_format($arqueo->total_ingresos, 2) }}
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-md-8 text-center">
                                                <b>Egresos:</b> <br>
                                                {{ number_format($arqueo->total_egresos, 2) }}
                                            </div>
                                        </div>
                                    </td>                                                                       
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.arqueos.show', $arqueo->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.arqueos.edit', $arqueo->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.arqueos.ingreso_egreso', $arqueo->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-cash-register"></i></a>
                                            <a href="{{ route('admin.arqueos.cierre', $arqueo->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-lock"></i></a>
                                                <form action="{{ route('admin.arqueos.destroy', $arqueo->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $arqueo->id }} (event)" id="mi_formulario{{ $arqueo->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $arqueo->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar este Arqueo de Caja?",
                                                            text: "Si elimina este arqueo de caja, se borarrán los movimientos asociados a el.",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $arqueo->id }}');
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
        $('#tabla_arqueos').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Arqueos de Caja",
                "infoEmpty": "Mostrando 0 a 0 de 0 Arqueos de Caja",
                "infoFiltered": "(Filtrado de _MAX_ total Arqueos de Caja)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Arqueos de Caja",
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