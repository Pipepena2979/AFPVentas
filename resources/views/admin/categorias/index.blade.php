@extends('adminlte::page')

@section('content_header')
    <h1><b>Categorías/Listado de Categorías</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Categorías Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.categorias.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Crear Categoría</a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table id="tabla_categorias" class="table table-hover table-success table-striped-columns">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Nombre de la Categoría</th>
                                <th scope="col" class="text-center">Descripción</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td class="text-center">{{ $contador++ }}</td>
                                    <td class="text-center">{{ $categoria->nombre }}</td>
                                    <td class="text-center">{{ $categoria->descripcion }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.categorias.show', $categoria->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.categorias.destroy', $categoria->id)}}" method="POST"
                                                    onclick="pregunta_eliminar{{ $categoria->id }} (event)" id="mi_formulario{{ $categoria->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <script>
                                                    function pregunta_eliminar{{ $categoria->id }} (event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Deseas eliminar esta Categoría? Si eliminas está Categoría, se eliminarán todos los productos asociados a ella.",
                                                            showDenyButton: true,
                                                            showCancelButton: false,
                                                            confirmButtonText: "Eliminar",
                                                            confirmButtonColor: "#28a745",
                                                            denyButtonText: `Cancelar`,
                                                            denyButtonColor: "#dc3545"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#mi_formulario{{ $categoria->id }}');
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
        $('#tabla_categorias').DataTable({
            "pageLength": 5,
            "responsive": true,
            "scrollX": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorías",
                "infoFiltered": "(Filtrado de _MAX_ total Categorías)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorías",
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