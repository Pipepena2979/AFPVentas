<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $empresa->nombre_empresa}} | Reporte Productos</title>
    <style>
        body {
            font-family: Arial, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0;
        }

        /* Estilos para el encabezado */
        .header {
            top: 0;
            left : 0;
            right: 0;
            height: 50px;
            background: #f0f0f0;
            text-align: center;
            line-height: 50px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        /* Estilos para el contenido principal */
        .content {
            margin: 10px 20px 50px 20px; /* Ajusta la distancia entre el encabezado y el pie de página */
        }

        /* Estilos para el pie de página */
        .footer {
            position: fixed;
            bottom: 0;
            left : 0;
            right: 0;
            height: 30px;
            background: #f0f0f0;
            text-align: center;
            line-height: 30px;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }

        .page-number:before {
            content: "Página " counter(page);
        }

        /* Estilos para la tabla del reporte */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #000000;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
        }

        .table-bordered thead th {
            border-bottom-width: 2px;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <b>SISTEMA DE VENTAS</b>
    </div>

    <div class="content">
        <h2>Reporte de Productos</h2>
        <div class="table-responsive">
            <table class="table table-bordered" cellpadding="4">
            <tr>
                <td width="30px" style="background-color: #cccccc; text-align: center"><b>Nro</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Código</b></td>
                <td width="100px" style="background-color: #cccccc; text-align: center"><b>Producto</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Stock</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Precio Compra</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Precio Venta</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Fecha de Ingreso</b></td>
                <td width="100px" style="background-color: #cccccc; text-align: center"><b>Fecha y Hora de Registro</b></td>
            </tr>
                <tbody style="text-align: center">
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $contador++ }}</td>
                        <td>{{ $producto->codigo }}</td>
                        <td>
                            <b>{{ $producto->nombre }}</b><br>
                            <small>{{ $producto->descripcion}}</small>
                        </td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $moneda->symbol}}<br>
                            {{ $producto->precio_compra }}
                        </td>
                        <td>{{ $moneda->symbol}}<br>
                            {{ $producto->precio_venta }}
                        </td>
                        <td>{{ $producto->fecha_ingreso }}</td>
                        <td>{{ $producto->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <small class="page-number"></small>
    </div>

</body>
</html>