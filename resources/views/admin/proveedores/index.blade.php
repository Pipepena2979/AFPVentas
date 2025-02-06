@extends('adminlte::page')

@section('content_header')
    <h1><b>Proveedores/Listado de Proveedores</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Proveedores Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.proveedores.reporte') }}" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Reporte</a>
                        <a href="{{ route('admin.proveedores.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Crear Proveedor</a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="tabla_proveedores" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Empresa</th>
                                <th scope="col" class="text-center">Dirección</th>
                                <th scope="col" class="text-center">Teléfono</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Nombre del Proveedor</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($proveedores as $proveedor)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $proveedor->empresa }}</td>
                                    <td class="text-center">{{ $proveedor->direccion }}</td>
                                    <td class="text-center">{{ $proveedor->telefono }}</td>
                                    <td class="text-center">{{ $proveedor->email }}</td>
                                    <td class="text-center">{{ $proveedor->nombre }}</td>
                                    <td class="text-center">
                                        <a href="https://wa.me/{{ $empresa->codigo_postal."".$proveedor->celular}}"
                                            class="btn btn-success btn-sm" target="_blank"><i class="fab fa-whatsapp"></i>
                                            {{ $empresa->codigo_postal."".$proveedor->celular}}</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.proveedores.show', $proveedor->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.proveedores.edit', $proveedor->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.proveedores.destroy', $proveedor->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $proveedor->id }} (event)" id="mi_formulario{{ $proveedor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $proveedor->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar este Proveedor?",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $proveedor->id }}');
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
        $('#tabla_proveedores').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay información",
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
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    </script>
@stop