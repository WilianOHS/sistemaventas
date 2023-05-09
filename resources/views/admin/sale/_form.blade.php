<div class="form-row">
    <div class="col-9">
    <label for="client_id">Cliente</label>
            <select id="client_id" class="form-control" name="client_id">
            <option value="" disabled selected>Seleccione un cliente</option>
            @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->name}}</option>
            @endforeach
            </select>
    </div>
    <div class="col">
    <label for="iva">Impuesto (IVA)</label>
      <select class="form-control" name="iva" id="iva">
        <option value="0">Sin IVA</option>
        <option value="13">Con IVA</option>
      </select>
    
    </div>
</div>

<hr>

        <div class="form-row">
        <label for="product_id">Producto</label>
            <select id="product_id" class="form-control" name="product_id">
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
            <!-- <div class="col">
            <label for="discount">Porcentaje de descuento</label>
                <input type="number" class="form-control" name="discount" id="discount" aria-describedby="helpId" value="0">
            </div> -->
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
                    <th colspan="4">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO (13%):</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden"
                                name="total" id="total_pagar"></p>
                    </th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
