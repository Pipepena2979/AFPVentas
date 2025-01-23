<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        body {
            font-family: Arial, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #333;
        }
        
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

    <title>Factura Venta | {{ $empresa->nombre_empresa }}</title>
  </head>
  <body>
    
    <table style="font-size: 8pt;" class="table">
        <tr>
            <td><img src="{{ public_path('storage/'.$empresa->logo) }}" width="100px" alt="logo"></td>
            <td width="500px"></td>
            <td style="text-align: center">
                <b>NIT: </b> {{ $empresa->nit}}<br>
                <b>Nro Factura: </b> {{ $venta->id }}<br>
            </td>
        </tr>
            <tr>
                <td style="text-align: center">
                {{ $empresa->nombre_empresa }}<br>
                {{ $empresa->tipo_empresa }}<br>
                {{ $empresa->correo }}<br>
                {{ $empresa->telefono }}<br>
                </td>
                <td width="500px" style="text-align: center"><h1>FACTURA</h1></td>
                <td style="text-align: center"><h4>ORIGINAL</h4></td>
            </tr>
    </table>

    <br>

    <?php

    $fecha_db = $venta->fecha;

    // CONVERTIR LA FECHA AL FORMATO DESEADO(EJEMPLO; 02 DE ENERO DE 2019) //
    $fecha_formateada = date("d", strtotime($fecha_db)) . " de " . date("F", strtotime($fecha_db)) . " de " . date("Y", strtotime($fecha_db));

    $meses = [
        'January' => 'Enero',
        'February' => 'Febrero',
        'March' => 'Marzo',
        'April' => 'Abril',
        'May' => 'Mayo',
        'June' => 'Junio',
        'July' => 'Julio',
        'August' => 'Agosto',
        'September' => 'Setiembre',
        'October' => 'Octubre',
        'November' => 'Noviembre',
        'December' => 'Diciembre'
    ];

    $fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);

    ?>
    

    <div style="border: 1.2px solid #212529">
        <table cellpadding="5" class="table">
            <tr>
                <td width="300px"><b>Fecha Venta:</b> {{ $fecha_formateada }}</td>
                <td width="230px"></td>
                <td><b>NIT/Código:</b> {{ $venta->cliente->nit_codigo ?? '0' }}</td>
            </tr>
            <tr>
                <td><b>Señor(es): </b> {{ $venta->cliente->nombre_cliente ?? 'S/N' }}</td>
            </tr>
        </table>
    </div>

    <br>

    <table class="table table-bordered">
        <tr>
            <td width="30px" style="background-color: #cccccc; text-align: center"><b>Nro</b></td>
            <td width="150px" style="background-color: #cccccc; text-align: center"><b>Productos</b></td>
            <td width="210px" style="background-color: #cccccc; text-align: center"><b>Descripción</b></td>
            <td width="90px" style="background-color: #cccccc; text-align: center"><b>Cantidad</b></td>
            <td width="110px" style="background-color: #cccccc; text-align: center"><b>Precio Unidad</b></td>
            <td width="90px" style="background-color: #cccccc; text-align: center"><b>SubTotal</b></td>
        </tr>
            <tbody style="text-align: center">
                @php
                    $contador = 1;
                    $total_cantidad = 0;
                    $total_precio_unidad = 0;
                    $total_venta = 0;
                @endphp
                @foreach ($venta->detallesVenta as $detalle)
                @php
                    $total_cantidad += $detalle->cantidad;
                    $total_precio_unidad += $detalle->producto->precio_venta; 
                    $total_venta = $venta->precio_total;
                @endphp
                <tr>
                    <td>{{ $contador++ }}</td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->producto->descripcion }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $moneda->symbol ." ". $detalle->producto->precio_venta }}</td>
                    <td>{{ $moneda->symbol ." ". $detalle->cantidad * $detalle->producto->precio_venta }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="background-color: #cccccc; text-align: center"><b>TOTAL</b></td>
                    <td style="background-color: #cccccc; text-align: center"><b>{{ $total_cantidad }}</b></td>
                    <td  style="background-color: #cccccc; text-align: center"><b>{{ $moneda->symbol ." ". $total_precio_unidad }}</b></td>
                    <td style="background-color: #cccccc; text-align: center"><b>{{ $moneda->symbol ." ". $total_venta }}</b></td>
                </tr>
            </tbody>
    </table>

    <p>
        <b>Monto a Cancelar: </b>{{ $moneda->symbol ." ". $total_venta }}<br><br>
        <b>Son: </b> {{ $numero_a_letras }}
    </p>

    <br>

    <p style="text-align: center">
        -------------------------------------------------------------------------------------------------------------------------------------------------
        <b>GRACIAS POR SU COMPRA</b>
    </p>
  </body>
</html>