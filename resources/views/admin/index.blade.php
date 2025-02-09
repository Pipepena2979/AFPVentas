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

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.ventas.index')}}" class="info-box-icon bg-olive">
                    <span><i class="fas fa-money-bill"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Ventas Registradas</span>
                    <span class="info-box-number">{{ $total_ventas }} ventas</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{route('admin.arqueos.index')}}" class="info-box-icon bg-navy">
                    <span><i class="fas fa-cash-register"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Arqueos de Caja Registrados</span>
                    <span class="info-box-number">{{ $total_arqueosCaja }} Arqueos de Caja</span>
                </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <!-- Gráfico de barras para roles -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distribución de Usuarios por Rol</h3>
                </div>
                <div class="card-body">
                    <div id="rolesChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>

    <!-- Gráfico de barras para categorías -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Productos por Categoría</h3>
                </div>
                <div class="card-body">
                    <div id="categoriasChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    
    <!-- Gráfico de torta para la distribución de compras, ventas, proveedores y clientes por empresa -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $empresa->nombre_empresa }}</h3>
                </div>
                <div class="card-body">
                    <div id="empresaChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    Highcharts.chart('rolesChart', {
        chart: {
            type: 'column' // Tipo de gráfico de columnas
        },

        title: {
            text: 'Distribución de Usuarios por Rol', // Título del gráfico
            align: 'center'
        },

        xAxis: {
            categories: @json($labelsRoles), // Nombres de los roles (pasados desde el controlador)
            title: {
                text: 'Roles' // Etiqueta del eje X
            }
        },

        yAxis: {
            allowDecimals: false, // No permitir decimales en el eje Y
            min: 0, // Valor mínimo del eje Y
            title: {
                text: 'Cantidad de Usuarios' // Etiqueta del eje Y
            }
        },

        tooltip: {
            format: '<b>{point.category}</b><br/>{series.name}: {y}<br/>' + // Formato del tooltip
                    'Total: {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal', // Columnas apiladas
                colorByPoint: true // Alternar colores por cada columna
            }
        },

        colors: [ // Array de colores personalizados
                    '#007bff', // Azul
                    '#28a745', // Verde
                    '#ffc107', // Amarillo
                    '#dc3545', // Rojo
                    '#6f42c1', // Morado
                    '#17a2b8', // Cyan
                    '#fd7e14', // Naranja
                    '#343a40'  // Gris oscuro
                ],

        series: [{
            name: 'Usuarios', // Nombre de la serie
            data: @json($dataRoles), // Cantidad de usuarios por rol (pasados desde el controlador)
            stack: 'roles' // Grupo de apilamiento
        }]
    });
    </script>
    <script>
    Highcharts.chart('categoriasChart', {
        chart: {
            type: 'column'
        },

        title: {
            text: 'Cantidad de Productos por Categoría'
        },

        xAxis: {
            type: 'category',
            categories: @json($labelsCategorias), // Nombres de las categorías
            labels: {
                autoRotation: [-45, -90], // Rotación automática de las etiquetas
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad de Productos'
            }
        },

        legend: {
            enabled: false // Ocultar la leyenda
        },

        tooltip: {
            pointFormat: '<b>{point.y}</b> productos en la categoría <b>{point.name}</b>'
        },

        series: [{
            name: 'Productos',
            colorByPoint: true, // Alternar colores por cada columna
            groupPadding: 0, // Espaciado entre grupos de columnas
            data: @json($dataCategorias), // Datos desde el controlador
            dataLabels: {
                enabled: true, // Mostrar etiquetas de datos
                rotation: -90, // Rotación de las etiquetas
                color: '#FFFFFF', // Color del texto
                inside: true, // Mostrar etiquetas dentro de las columnas
                verticalAlign: 'top', // Alineación vertical
                format: '{point.y:.0f}', // Formato sin decimales
                y: 10, // Posición vertical de las etiquetas
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    </script>
    <script>
        Highcharts.chart('empresaChart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie' // Tipo de gráfico: pie (torta)
            },

            title: {
                text: 'Porcentaje de Compras, Ventas, Proveedores, Clientes y Arqueos de Caja' // Título del gráfico
            },

            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' // Formato del tooltip
            },

            accessibility: {
                point: {
                    valueSuffix: '%' // Sufijo para accesibilidad
                }
            },

            plotOptions: {
                pie: {
                    allowPointSelect: true, // Permitir seleccionar porciones
                    cursor: 'pointer', // Cambiar el cursor al pasar sobre las porciones
                    dataLabels: {
                        enabled: true, // Mostrar etiquetas de datos
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %' // Formato de las etiquetas
                    },
                    showInLegend: true // Mostrar leyenda
                }
            },

            series: [{
                name: 'Porcentaje', // Nombre de la serie
                colorByPoint: true, // Alternar colores por cada porción
                data: @json($dataEmpresa) // Datos desde el controlador
            }]
        });
    </script>
@stop