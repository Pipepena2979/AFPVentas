@extends('adminlte::page')

@section('content_header')
    <h1><b>Productos/Producto Registrado</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoria">Nombre de la Categoría</label>
                                    <p>{{ $categoria->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código del Producto</label>
                                    <p>{{ $producto->codigo }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Producto</label>
                                    <p>{{ $producto->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <p>{{ $producto->descripcion }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label> <br>
                                    <input type="text" name="stock" value="{{ $producto->stock }}" style="width: 3rem; background-color: rgba(233, 231, 16, 0.15); text-align: center" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock_min">Stock Mínimo</label>
                                    <p>{{ $producto->stock_min }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock_max">Stock Máximo</label>
                                    <p>{{ $producto->stock_max }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_compra">Precio Compra</label>
                                    <p>{{ $producto->precio_compra }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_venta">Precio Venta</label>
                                    <p>{{ $producto->precio_venta }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="imagen">Imagen</label> <br>
                                        <img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="imagen producto">
                                </div>
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.productos.index') }}" class="btn btn-info btn-block"><i class="fas fa-arrow-left"></i> Volver</a>
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
@stop