@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos/Registrar Nuevo Producto</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Datos</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.productos.store')}}" method="POST" enctype="multipart/form-data">
                    {{-- Token de Seguridad --}}
                    @csrf
                    <div class="row">
                        <!-- Primera Columna para el Logo -->
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="imagen_producto">Imagen del Producto</label>
                                <input type="file" id="file" name="imagen_producto" accept="image/*" class="form-control">
                                @error('imagen_producto')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <center><output id="list"></output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; // Lista de archivos
                                        for (var i = 0, f; f = files[i]; i++) {
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function (theFile) {
                                                return function (e) {
                                                    document.querySelector("#list").innerHTML = [
                                                        '<img class="thumb thumbnail" src="', e.target.result,
                                                        '" width="100%" title="', escape(theFile.name), '"/>'
                                                    ].join('');
                                                };
                                            })(f);
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false);
                                </script>
                            </div>
                        </div>
                    
                        <!-- Segunda Columna con otros campos distribuidos en 3 filas -->
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <!-- Primera fila -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="categoria_id">Nombre de la Categoría</label>
                                        <select name="categoria_id" id="categoria_id" class="form-control">
                                            <option value="" disabled selected>Seleccione una Categoría</option>
                                            @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2 col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control" required>
                                        @error('codigo')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Producto</label>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                                        @error('nombre')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Segunda fila -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" id="" cols="1.5" rows="1.5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Tercera fila -->
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" value="0" class="form-control" required>
                                        @error('stock')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="stock_min">Stock Mínimo</label>
                                        <input type="number" name="stock_min" value="0" class="form-control" required>
                                        @error('stock_min')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="stock_max">Stock Máximo</label>
                                        <input type="number" name="stock_max" value="0" class="form-control" required>
                                        @error('stock_max')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Cuarta fila -->
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="precio_compra">Precio Compra</label>
                                        <input type="text" name="precio_compra" value="{{ old('precio_compra') }}" class="form-control" required>
                                        @error('precio_compra')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio Venta</label>
                                        <input type="text" name="precio_venta" value="{{ old('precio_venta') }}" class="form-control" required>
                                        @error('precio_venta')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha Ingreso</label>
                                        <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="form-control" required>
                                        @error('fecha_ingreso')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
@stop

@section('css')
@stop

@section('js')
@stop