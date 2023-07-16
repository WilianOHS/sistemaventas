<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Crédito Fiscal</title>
    <style>
  .visually-hidden {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
</style>
</head>
<body>
	<header>
        <div>
        <pre><strong>          </strong> {{$sale->client->name}}</pre>
        <pre><strong>          </strong> {{$sale->client->dui}}</pre>
        <pre><strong>          </strong> {{$sale->client->address}}</pre>
		</div>
	</header>
	<section>
		<table>
			<thead>
            <tr>
      <th><span class="visually-hidden">Cantidad</span></th>
      <th><span class="visually-hidden">Producto</span></th>
      <th><span class="visually-hidden">Precio</span></th>
      <th><span class="visually-hidden">Subtotal</span></th>
    </tr>
			</thead>
			<tbody>
            @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td>{{$saleDetail->quantity}}</td>
                        <td>{{$saleDetail->product->name}}</td>
                        <td>$ {{ ($saleDetail->price / 1.13) }}</td>
                        <td>$ {{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                        </td>
                    </tr>
                    @endforeach
			</tbody>
            
			<tfoot>
				<tr>
					
                </tfoot>
				<td colspan="3"></td>
				<td>$ {{number_format($sale->total, 2)}}</td>
			</tr>
		</table>
	</section>
</body>
</html>