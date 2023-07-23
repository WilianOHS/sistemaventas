<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de compra</title>
  <style>
    /* Estilos globales */
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #555555;
      background: #f5f5f5;
      width: 90%;
      margin: 0 auto;
      padding: 1rem;
    }

    /* Estilos para el encabezado */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    /* Estilos del logotipo */
    #logo {
      height: 5rem;
      width: auto;
    }

    /* Estilos para las tablas de datos */
    table {
      border-collapse: collapse;
      margin-bottom: 1rem;
      width: 100%;
    }

    table thead {
      background-color: #33AFFF;
      color: #FFFFFF;
      font-size: 15px;
      padding: 12px;
      text-align: center;
    }

    table tbody th {
      text-align: left;
    }

    /* Estilos del número de compra */
    #fact {
      background-color: #33AFFF;
      color: #FFFFFF;
      font-size: 20px;
      text-align: center;
    }

    /* Estilos para el pie de página */
    footer {
      text-align: center;
      font-size: 12px;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <header>
  <div id="fact">
      <p>NUMERO DE COMPRA: {{$purchase->id}}</p>
    </div>
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
                @isset($purchase->provider)
                    <p>Nombre: {{$purchase->provider->name}}</p>
                    <p>Dirección: {{$purchase->provider->address}}</p>
                    <p>Teléfono: {{$purchase->provider->phone}}</p>
                    <p>Email: {{$purchase->provider->email}}</p>
                @else
                    <p>Proveedor Eliminado</p>
                @endisset
            </th>
        </tr>
        </tbody>
      </table>
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
          <td>
              @isset($purchase->user)
                  {{ $purchase->user->name }}
              @else
                  Usuario Eliminado
              @endisset
          </td>
          <td>{{$purchase->created_at->format('d/m/Y')}}</td>
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
            <p align="right">$ {{number_format($subtotal,2)}}</p>
          </td>
        </tr>
        <tr>
          <th colspan="3">
            <p align="right">TOTAL PAGAR:</p>
          </th>
          <td>
            <p align="right">$ {{number_format($purchase->total,2)}}</p>
          </td>
        </tr>
      </tfoot>
    </table>
  </section>
  <br>
  <br>
  <footer>
    <!-- Puedes poner un mensaje aquí -->
    <div id="datos">
      <p id="encabezado"></p>
    </div>
  </footer>
</body>
</html>
