@extends('adminlte::page')

@section('content_header')
    <h1><b>Bienvenido</b> {{ $empresa->nombre_empresa }}</h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.roles.index')}}" class="info-box-icon bg-success">
                    <span><i class="fas fa-user-check"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Roles Registrados</span>
                    <span class="info-box-number">{{ $total_roles }} roles</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.usuarios.index')}}" class="info-box-icon bg-primary">
                    <span><i class="fas fa-users"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios Registrados</span>
                    <span class="info-box-number">{{ $total_usuarios }} usuarios</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.categorias.index')}}" class="info-box-icon bg-yellow">
                    <span><i class="fas fa-tags"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Categorías Registradas</span>
                    <span class="info-box-number">{{ $total_categorias }} categorías</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.productos.index')}}" class="info-box-icon bg-danger">
                    <span><i class="fas fa-list"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Productos Registrados</span>
                    <span class="info-box-number">{{ $total_productos }} productos</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.proveedores.index')}}" class="info-box-icon bg-gray">
                    <span><i class="fas fa-truck"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Proveedores Registrados</span>
                    <span class="info-box-number">{{ $total_proveedores }} proveedores</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.compras.index')}}" class="info-box-icon bg-purple">
                    <span><i class="fas fa-cart-plus"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Compras Registradas</span>
                    <span class="info-box-number">{{ $total_compras }} compras</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.clientes.index')}}" class="info-box-icon bg-maroon">
                    <span><i class="fas fa-users"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Clientes Registrados</span>
                    <span class="info-box-number">{{ $total_clientes }} clientes</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop