<div class="row">
  <div class="col">
    <div class="form-row">
      <label for="payment_method">Método de Pago:</label>
      <select id="payment_method" class="form-control" name="payment_method">
        <option value="Efectivo">Efectivo</option>
        <option value="Tarjeta">Tarjeta</option>
      </select>
    </div>
  </div>
  
  <div class="col">
  <div class="form-row">
    <label for="document_type">Tipo de comprobante:</label>
    <select id="document_type" class="form-control" name="document_type" required>
      <option value="Ticket">Ticket</option>
      <option value="Factura">Factura</option>
      <option value="credito_fiscal">Crédito Fiscal</option>
    </select>
  </div>
</div>

<div class="col">
  <div class="form-row">
    <label for="document_number">Número de comprobante:</label>
    <input type="text" class="form-control" name="document_number" id="document_number" aria-describedby="helpId" required>
  </div>
</div>

</div>
    <hr>
    <div class="form-row">
    <label for="client_id">Cliente</label>
    <select id="client_id" class="form-control selectpicker" data-live-search="true" name="client_id" required>
        <option value="" disabled selected>Seleccione un cliente (Asegurese de tener registrado el cliente)</option>
        @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
    </select>
</div>



<hr>
<div class="form-group">
  <label for="code">Código de barras</label>
  <input type="text" name="code" id="code" class="form-control" placeholder="" aria-describedby="helpId" onkeydown="handleKeyDown(event)">
</div>
<hr>

<div class="form-row">
    <label for="product_id">Producto</label>
    <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id">
        <option value="" disabled selected>Seleccione un producto</option>
        @foreach ($products as $product)
            <option value="{{$product->id}}_{{$product->stock}}_{{$product->sale_price}}">{{$product->name}}</option>
        @endforeach
    </select>
</div>

        <hr>

        <div class="form-row">
            <div class="col">
            <label for="">Stock Actual</label>
                <input type="text" name="" id="stock" value="" class="form-control" disabled>
            </div>
            <div class="col">
            <label for="quantity">Cantidad</label>
                <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId">
            </div>
            <div class="col">
            <label for="price">Precio de venta</label>
                <input type="number" class="form-control" name="price" id="price" aria-describedby="helpId" disabled>
            </div>
            <div class="col">
            <label for="discount">Porcentaje de descuento</label>
            <input type="number" class="form-control" name="discount" id="discount" aria-describedby="helpId" value="0" min="0" max="100" step="1" oninput="validarDescuento()">
            </div>

        </div>

<hr>
        <div class="form-group">
            <button type="button" id="agregar" class="btn btn-primary float-right">Agregar producto</button>
        </div>

        <div class="form-group">
        <h4 class="card-title">Detalles de venta</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio de venta(USD)</th>
                    <th>Descuento</th>
                    <th>Cantidad</th>
                    <th>SubTotal(USD)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="5">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden"
                                name="total" id="total_pagar"></p>
                    </th>
                </tr>
                <tr>
  <th colspan="5">
    <p align="right">EFECTIVO RECIBIDO:</p>
  </th>
  <th>
    <p align="right">
      <span align="right" id="efectivo_recibido">$ 0.00</span>
      <input type="hidden" name="efectivo_recibido" id="cash_hidden" />
    </p>
  </th>
</tr>
<tr>
  <th colspan="5">
    <p align="right">CAMBIO:</p>
  </th>
  <th>
    <p align="right">
      <span align="right" id="cambio">$ 0.00</span>
      <input type="hidden" name="cambio" id="cambio_hidden" />
    </p>
  </th>
</tr>


            <tr>
  <th colspan="5">
    <p align="right"><label for="cash">Efectivo recibido</label></p>
  </th>
  <th>
    <p align="right">
      <input type="number" class="form-control" name="cash" id="cash" aria-describedby="helpId" value="0" >
    </p>
  </th>
</tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
