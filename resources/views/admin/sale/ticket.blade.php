<!DOCTYPE html>
<html>
<head>
    <title>Ticket de compra</title>
    <style>
        /* Estilos para el ticket */
        body {
            font-family: Arial, sans-serif;
        }
        .ticket {
            width: 300px;
            padding: 10px;
            border: 1px solid #000;
        }
        .logo {
            text-align: center;
        }
        .logo img {
            width: 80px;
        }
        .info {
            margin-top: 10px;
            font-size: 12px;
        }
        .info p {
            margin: 0;
        }
        .items {
            margin-top: 10px;
            font-size: 14px;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #000;
        }
        .total {
            margin-top: 10px;
            font-size: 14px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="logo">
            <img src="ruta_del_logo.png" alt="Logo">
        </div>
        <div class="info">
            <p>Fecha: {{ $sale->sale_date }}</p>
            <p>Número de ticket: {{$sale->document_number}}</p>
            <p>Cliente: {{$sale->client->name}}</p>
            <p>Vendedor: {{$sale->user->name}}</p>
        </div>
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Venta (USD)</th>
                        <th>Descuento(USD)</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleDetails as $saleDetail)
                    <tr>
                        <td>{{$saleDetail->product->name}}</td>
                        <td>$ {{$saleDetail->price}}</td>
                        <td>{{$saleDetail->discount}} %</td>
                        <td>{{$saleDetail->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            Total: ${{number_format($sale->total,2)}}
        </div>
    </div>
</body>
</html>
