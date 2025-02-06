<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $empresa->nombre_empresa}} | Reporte Proveedores</title>
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
        <h2>Reporte de Proveedores</h2>
        <div class="table-responsive">
            <table class="table table-bordered" cellpadding="4">
            <tr>
                <td width="30px" style="background-color: #cccccc; text-align: center"><b>Nro</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Empresa</b></td>
                <td width="100px" style="background-color: #cccccc; text-align: center"><b>Dirección</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Teléfono</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Correo del Proveedor</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Nombre del Proveedor</b></td>
                <td width="70px" style="background-color: #cccccc; text-align: center"><b>Celular del Proveedor</b></td>
                <td width="100px" style="background-color: #cccccc; text-align: center"><b>Fecha y Hora de Registro</b></td>
            </tr>
                <tbody style="text-align: center">
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $contador++ }}</td>
                        <td>{{ $proveedor->empresa }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->email }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->celular }}</td>
                        <td>{{ $proveedor->created_at }}</td>
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