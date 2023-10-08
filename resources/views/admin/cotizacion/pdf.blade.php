<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
/* Estilos CSS personalizados */
body {
    font-family: 'Times New Roman', Times, serif;
    margin: 20px;
    line-height: 0;
}

.header {
    text-align: center;
}

.logo {
    max-width: 150px;
    float: left;
    margin-right: 20px; /* Agrega un margen derecho para separar la imagen del texto */
}

.info-empresa {
    text-align: left;
    margin-bottom: 20px;
    text-align: center; /* Centra el contenido */
    word-wrap: break-word; /* Permite envolver el texto automáticamente */
    max-width: 100%; /* Establece el ancho máximo del contenedor al 100% del contenedor padre */
}


.info-cliente {
    text-align: left;
    margin-bottom: 20px;
}

.productos {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.productos th, .productos td {
    border: 1px solid #ccc;
    padding: 10px;
}

.productos th {
    background-color: #f2f2f2;
}

.footer {
    text-align: center;
    font-size: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

section {
    margin: 20px 0;
}

table {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
    table-layout: fixed; /* Fija el ancho de la tabla para evitar traslapos */
}


table th, table td {
    border: 1px solid #ccc;
    padding: 10px;
    word-wrap: break-word; /* Evita que el contenido de las celdas se desborde */
    text-transform: uppercase;
    line-height: 1;
}

table th {
    background-color: #f2f2f2;
}
/* Estilos CSS para el cuadro decorado y el eslogan */
.slogan-box {
    background-color: #f0f0f0; /* Color de fondo del cuadro */
    padding: 10px; /* Espacio alrededor del cuadro */
    text-align: center;
    border: 2px solid #777; /* Borde del cuadro */
    border-radius: 5px; /* Bordes redondeados */
}

.slogan {
    font-size: 14px;
    color: #333;
    margin: 0;
    line-height: 1;
    font-style: italic; /* Agrega la propiedad para hacer el texto cursiva */
}
.logo-img {
    height: 100px;
}

    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('image/'.$business1->logo) }}" alt="Logo" class="logo-img">
        </div>
    </div>



    <div class="info-empresa">
    <p> {{$business1->name}}</p>
    <p style="line-height: 0.9;"> {{$business1->address}}</p>
    <p> {{$business1->number}}</p>
    <p> {{$business1->mail}}</p>
</div>


    <div class="info-cliente" style="float: left; width: 50%;">
    <p><strong>CLIENTE: </strong> {{ optional($cotizacion->client)->name ?? 'Cliente Eliminado' }}</p>
        <p><strong>DIRECCION: </strong>{{ optional($cotizacion->client)->address ?? '   ' }} </p>
        <p><strong>TELEFONO: </strong>{{ optional($cotizacion->client)->phone ?? ' ' }} </p>
        <p><strong>CORREO: </strong>{{ optional($cotizacion->client)->email ?? ' ' }} </p>

    </div>

    <div class="info-cotizacion" style="float: right; width: 50%;">
    @php
    $cotizacionIdFormatted = sprintf("%03d", $cotizacion->id);
    $meses = [
    '01' => 'ENERO',
    '02' => 'FEBRERO',
    '03' => 'MARZO',
    '04' => 'ABRIL',
    '05' => 'MAYO',
    '06' => 'JUNIO',
    '07' => 'JULIO',
    '08' => 'AGOSTO',
    '09' => 'SEPTIEMBRE',
    '10' => 'OCTUBRE',
    '11' => 'NOVIEMBRE',
    '12' => 'DICIEMBRE',
];

$fecha = \Carbon\Carbon::parse($cotizacion->cotizacion_date);
$dia = $fecha->format('d');
$mes = $meses[$fecha->format('m')];
$anio = $fecha->format('Y');

$cotizacionDateFormatted = "$dia DE $mes DE $anio";


    @endphp

    <p><b>COTIZACIÓN No.: </b> {{ $cotizacionIdFormatted }}</p>
    <p><b>FECHA: </b> {{ $cotizacionDateFormatted }}</p>

    <p><b>VENDEDOR: </b> @isset($cotizacion->user)
        {{$cotizacion->user->name}}
    @else
        Usuario Eliminado
    @endisset</p>
</div>

<div style="clear: both; line-height: 0.9;"><p>Reciban un cordial saludo de parte de AGROFERRETERIA SAN FRANCISCO, a continuacion se le presentan los precios solicitados.</p></div>


    <section>
        <table>
        <thead>
    <tr style="font-size: 10px;">
        <th style="width: 12%;">CANTIDAD</th>
        <th style="width: 16%;">PRESENTACION</th>
        <th style="width: 40%;">DESCRIPCION</th>
        <th style="width: 18%;">PRECIO UNITARIO</th>
        <th style="width: 14%;">TOTAL</th>
    </tr>
</thead>

            <tbody>
            @foreach ($cotizacionDetails as $cotizacionDetail)
                <tr>
                    <td style="text-align: center;">{{$cotizacionDetail->quantity}}</td>
                    <td style="text-align: center;">{{$cotizacionDetail->product->presentation}}</td>
                    <td>{{$cotizacionDetail->product->name}}</td>
                    <td style="text-align: right;">$ {{$cotizacionDetail->price}}</td>
                    <td style="text-align: right;">$ {{number_format($cotizacionDetail->quantity*$cotizacionDetail->price - $cotizacionDetail->quantity*$cotizacionDetail->price*$cotizacionDetail->discount/100,2)}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    
            </tfoot>
            <td style="text-align: center;" colspan="4">TOTAL:</td>
            <td style="text-align: right;">$ {{number_format($cotizacion->total, 2)}}</td>
            </tr>
        </table>
    </section>

    <footer>
        
        <p style="text-align: center; font-size: 10pt;"></p>
        <br><br>
        <p>f.______________</p>
        <p style="font-size: 10pt;"> @isset($cotizacion->user)
            {{$cotizacion->user->name}}
        @else
            Usuario Eliminado
        @endisset</p>
        <br>
        <p>OBSERVACIONES</p>
        <P>*Entrega inmediata 8 dias despues de la orden de compra</P>
        <p>*Precios incluye IVA</p>
        <p>*Precios no incluyen transporte</p>
    </footer>
</body>
</html>
