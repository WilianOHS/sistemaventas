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
            font-size: 14px;
            text-align: center;
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
        .message {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="logo">
            <img src="{{ asset('image/'.$business->logo) }}" alt="Logo">
        </div>
        <div class="info">
            <p>{{$business->name}}</p>
            <p>{{$business->address}}</p>
            <p>Tel: {{$business->number}}</p>
        </div>
        <div class="info">
            <p>Fecha: {{ $saleDate->format('d/m/Y h:i A') }}</p>
            <p>Número de ticket: {{$sale->document_number}}</p>
            <p>Cliente: {{$sale->client->name}}</p>
            <p>Vendedor: {{$sale->user->name}}</p>
        </div>
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Desc.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleDetails as $saleDetail)
                    <tr>
                        <td>{{$saleDetail->quantity}}</td>
                        <td>{{$saleDetail->product->name}}</td>
                        <td>$ {{$saleDetail->price}}</td>
                        <td>{{$saleDetail->discount}} %</td>
                        <td>${{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            Total: ${{number_format($sale->total,2)}}
        </div>
        <div class="message">
            {{$business->message}}
        </div>
    </div>
</body>
</html>
