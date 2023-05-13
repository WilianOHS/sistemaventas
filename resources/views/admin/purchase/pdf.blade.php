<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de compra</title>
  <style>
    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #555555;
      /*background: #FFFFFF;*/
      /*width: 16cm;*/ 
      /*height: 29.7cm;*/
      /*position: relative;*/
      /*margin: 0 auto;*/
    }
    
    /* Header styles */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    /* Logo styles */
    #logo {
      height: 5rem;
      width: auto;
    }
    
    /* Data table styles */
    table {
      border-collapse: collapse;
      margin-bottom: 1rem;
    }
    
    table thead {
      background-color: #33AFFF;
      color: #FFFFFF;
      font-size: 15px;
      padding: 20px;
      text-align: center;
    }
    
    table tbody th {
      text-align: left;
    }
    
    /* Invoice number styles */
    #fact {
      background-color: #33AFFF;
      color: #FFFFFF;
      font-size: 20px;
      padding: 20px;
    }
    
    /* Footer styles */
    footer {
      text-align: center;
      font-size: 12px;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <header>
    <!-- <div id="logo">
      <img src="img/logo.png" alt="" id="imagen">
    </div> -->
    <div>
      <table>
        <thead>
          <tr>
            <th>DATOS DEL PROVEEDOR</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>
              <p>Nombre: {{$purchase->provider->name}}</p>
              <p>Dirección: {{$purchase->provider->address}}</p>
              <p>Teléfono: {{$purchase->provider->phone}}</p>
              <p>Email: {{$purchase->provider->email}}</p>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="fact">
      <p>NUMERO DE COMPRA<br />{{$purchase->id}}</p>
    </div>
  </header>

  <section>
    <table>
      <thead>
        <tr>
          <th>COMPRADOR</th>
          <th>FECHA COMPRA</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$purchase->user->name}}</td>
          <td>{{$purchase->created_at}}</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section>
    <table>
      <thead>
        <tr>
          <th>CANTIDAD</th>
          <th>PRODUCTO</th>
          <th>PRECIO COMPRA (USD)</th>
          <th>SUBTOTAL (USD)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($purchaseDetails as $purchaseDetail)
        <tr>
          <td>{{$purchaseDetail->quantity}}</td>
                        <td>{{$purchaseDetail->product->name}}</td>
                        <td>$ {{$purchaseDetail->price}}</td>
                        <td>$ {{number_format($purchaseDetail->quantity*$purchaseDetail->price,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                 
                    <tr>
                        <th colspan="3">
                            <p align="right">SUBTOTAL:</p>
                        </th>
                        <td>
                            <p align="right">$ {{number_format($subtotal,2)}}<p>
                        </td>
                    </tr>
                  
                    <tr>
                        <th colspan="3">
                            <p align="right">TOTAL IMPUESTO ({{$purchase->iva}}%):</p>
                        </th>
                        <td>
                            <p align="right">$ {{number_format($subtotal*$purchase->iva/100,2)}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <p align="right">TOTAL PAGAR:</p>
                        </th>
                        <td>
                            <p align="right">$ {{number_format($purchase->total,2)}}<p>
                        </td>
                    </tr>
                  
                </tfoot>
            </table>
        </div>
    </section>
    <br>
    <br>
    <footer>
        <!--puedes poner un mensaje aqui-->
        <div id="datos">
            <p id="encabezado">
            </p> 
        </div>
    </footer>
</body>

</html>