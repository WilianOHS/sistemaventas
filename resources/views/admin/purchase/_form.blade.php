        <div class="form-group">
        <label for="provider_id">Proveedor</label>
            <select id="provider_id" class="form-control" name="provider_id">
            <option value="" disabled selected>Seleccione un proveedor</option>
            @foreach ($providers as $provider)
            <option value="{{$provider->id}}">{{$provider->name}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="iva">Impuesto (IVA)</label>
            <!--    <input type="number" class="form-control" name="iva" id="iva" aria-describedby="helpId" placeholder="13%"> -->
            <div class="form-group">
            <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-dark active"> Con IVA
                        <input type="radio" name="iva" id="iva" autocomplete="off" value="13">
                    </label>

                    <label class="btn btn-dark">Sin IVA
                        <input type="radio" name="iva" id="iva" autocomplete="off" value="0">
                    </label>
                </div>
        </div>

        <div class="form-group">
        <label for="product_id">Producto</label>
            <select id="product_id" class="form-control" name="product_id">
            <option value="" disabled selected>Seleccione un producto</option>
            @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Cantidad</label>
                <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <label for="price">Precio de compra</label>
                <input type="number" class="form-control" name="price" id="price" aria-describedby="helpId">
        </div>

        <div class="form-group">
            <button type="button" id="agregar" class="btn btn-primary float-right">Agregar producto</button>
        </div>

        <div class="form-group">
        <h4 class="card-title">Detalles de compra</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio(USD)</th>
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
                        <p align="right"><span id="total">USD 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO (13%):</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">USD 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right"><span align="right" id="total_pagar_html">USD 0.00</span> <input type="hidden"
                                name="total" id="total_pagar"></p>
                    </th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>


        </div>
