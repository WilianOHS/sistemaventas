<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reporte de venta</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			color: #555555;
			background: #FFFFFF;
		}
		header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin: 20px 0;
		}
		h1 {
			font-size: 28px;
			font-weight: bold;
			color: #D2691E;
			margin: 0;
		}
		section {
			margin: 20px 0;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			font-size: 14px;
		}
		th, td {
			padding: 10px;
			border: 1px solid #D2691E;
			text-align: center;
		}
		th {
			background-color: #D2691E;
			color: white;
			font-weight: normal;
			font-size: 16px;
		}
		tfoot th {
			background-color: #D2691E;
			color: white;
			font-weight: bold;
			font-size: 16px;
			text-align: right;
		}
		tfoot td {
			background-color: #F7F7F7;
			border: none;
			font-weight: bold;
			text-align: right;
		}
		footer {
			text-align: center;
			margin-top: 50px;
			padding-top: 20px;
			border-top: 1px solid #D2691E;
		}
		footer p {
			font-size: 12px;
			color: #555555;
			margin: 0;
		}
	</style>
</head>
<body>
	<header>
        <div>
			<h1>Reporte de venta</h1>
			<p><strong>Tipo de comprobante:</strong> 
			@if($sale->document_type == 'credito_fiscal')
                Crédito Fiscal
            @else
                {{$sale->document_type}}
            @endif</p>
			<p><strong>Número de comprobante:</strong> {{$sale->document_number}}</p>
		</div>
		<div>
			<p><strong>DATOS DEL VENDEDOR</strong></p>
			<p><strong>Nombre:</strong> 
				@isset($sale->user)
					{{$sale->user->name}}
				@else
					Usuario Eliminado
				@endisset
			</p>

		</div>
        <div>
		<p><strong>DATOS DEL CLIENTE</strong></p>
		@if(isset($sale->client))
			<p><strong>Nombre:</strong> {{ $sale->client->name }}</p>
			@if($sale->client->dui)
				<p><strong>DUI:</strong> {{ $sale->client->dui }}</p>
			@else
				<p><strong>DUI:</strong> </p>
			@endif
		@else
		<p><strong>Nombre:</strong> Cliente Eliminado</p>
		@endif
		</div>
	</header>
	<section>
		<table>
			<thead>
				<tr>
					<th>Cantidad</th>
					<th>Producto</th>
					<th>Precio de venta (USD)</th>
					<th>Descuento (%)</th>
					<th>Subtotal (USD)</th>
				</tr>
			</thead>
			<tbody>
            @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td>{{$saleDetail->quantity}}</td>
                        <td>{{$saleDetail->product->name}}</td>
                        <td>$ {{$saleDetail->price}}</td>
                        <td>{{$saleDetail->discount}}</td>
                        <td>$ {{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                        </td>
                    </tr>
                    @endforeach
			</tbody>
			<tfoot>
				<tr>
					
                </tfoot>
				<td colspan="4">Total:</td>
				<td>$ {{number_format($sale->total, 2)}}</td>
			</tr>
		</table>
	</section>
	<footer>
		<p>Este reporte fue generado automáticamente por el sistema.</p>
	</footer>
</body>
</html>