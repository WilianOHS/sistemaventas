@extends('layouts.admin')
 @section('title','Registro de cotización')
 @section('styles')
 {!! Html::style('bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css') !!}
 @endsection
 @section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Registro de cotización
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('cotizaciones.index')}}">Cotizaciones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de cotización</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
              <!-- <a href="#" data-toggle="modal" data-target="#clientModal" id="addClientBtn">Agregar cliente</a> -->
              <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#clientModal">Registro rapido de cliente</button>
              </div>
                {!! Form::open(['route'=>'cotizaciones.store','method'=>'POST']) !!}
                <div class="card-body">

                    @include('admin.cotizacion._form')
                    
                   
                </div>
                <div class="card-footer text-muted">
                <button type="submit" id="guardar" class="btn btn-primary float-right">Registrar</button>
                    <a href="{{route('cotizaciones.index')}}" class="btn btn-light">
                        Cancelar
                    </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>            


<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="clientModalLabel">Registrar cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      {!! Form::open(['route'=>'cotizaciones.storeClient','method'=>'POST']) !!}
          @csrf
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="dui">DUI</label>
            <input type="text" name="dui" id="dui" class="form-control"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10">
          </div>
          <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" id="address" class="form-control">
          </div>
         <div class="form-group">
                        <label for="phone">Telefóno / Celular</label>
                        <input type="text" name="phone" id="phone" class="form-control" aria-describedby="helpId" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="9">
                    </div>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- <button type="submit" class="btn btn-primary">Guardar</button> -->
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>

          {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>  




@endsection
@section('scripts')
{!! Html::script('melody/js/alerts.js') !!}
{!! Html::script('melody/js/avgrund.js') !!}
{!! Html::script('bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js') !!}


<script>
  $('#clientModal').on('show.bs.modal', function (e) {
    $('#addClientBtn').attr('disabled', true);
  });

  $('#clientModal').on('hidden.bs.modal', function (e) {
    $('#addClientBtn').attr('disabled', false);
  });
</script>

<script>
$(document).ready(function () {
  $("#agregar").click(function () {
    agregar();
  });

});



var cont = 1;
total = 0;
subtotal = [];
$("#guardar").hide();
$('#product_id').change(mostrarValores);
function mostrarValores() {
  datosProducto = document.getElementById('product_id').value.split('_');
  $("#price").val(datosProducto[2]);
  $("#stock").val(datosProducto[1]);
}

function obtener_registro(code) {
    $.ajax({
        url: "{{route('get_product_by_barcode')}}",
        type: 'GET',
        data: {
            code: code
        },
        dataType: 'json',
        success: function(data) {
            if (data) {
                $("#product_id").val(data.id + "_" + data.stock + "_" + data.sale_price).change();
                $("#code").val(data.code); // Agregar esta línea para actualizar el campo de entrada del código de barras
            } else {
                $("#product_id").val("").change();
                $("#code").val(""); // Agregar esta línea para borrar el campo de entrada del código de barras si no se encuentra ningún producto
            }
        },
        error: function() {
            $("#product_id").val("").change();
            $("#code").val(""); // Agregar esta línea para borrar el campo de entrada del código de barras en caso de error
        }
    });
}

$(document).on('change', '#product_id', function() {
    var selectedValue = $(this).val();
    if (selectedValue !== "") {
        var parts = selectedValue.split("_");
        var code = parts[0]; // Extraer el código de la opción seleccionada
        $("#code").val(code);
    } else {
        $("#code").val(""); // Agregar esta línea para borrar el campo de entrada del código de barras si no se ha seleccionado ningún producto
    }
});

$(document).on('keyup', '#code', function() {
    var code = $(this).val();
    if (code !== "") {
        obtener_registro(code);
    } else {
        $("#product_id").val("").change();
    }
});





function agregar() {
    datosProducto = document.getElementById('product_id').value.split('_');

    product_id = datosProducto[0];
    producto = $("#product_id option:selected").text();
    quantity = $("#quantity").val();
    discount = $("#discount").val();
    price = $("#price").val();
    stock = $("#stock").val();
    //impuesto = $("#iva").val();

    if (product_id != "" && quantity != "" && quantity > 0 && discount != "" && price != "") {
        if (parseInt(stock) >= parseInt(quantity)) {
            // Calcular el precio unitario con descuento
            var unitPriceWithDiscount = parseFloat(price) - (parseFloat(price) * parseFloat(discount) / 100);

            // Calcular el subtotal
            subtotal[cont] = (quantity * unitPriceWithDiscount);
            total = total + subtotal[cont];

            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="product_id[]" value="' + product_id + '">' + producto + '</td> <td> <input type="hidden" name="price[]" value="' + parseFloat(price).toFixed(2) + '"> <input class="form-control" type="number" value="' + parseFloat(price).toFixed(2) + '" disabled> </td> <td> <input type="hidden" name="discount[]" value="' + parseFloat(discount) + '"> <input class="form-control" type="number" value="' + parseFloat(discount) + '" disabled> </td> <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input type="number" value="' + quantity + '" class="form-control" disabled> </td> <td align="right">$ ' + parseFloat(subtotal[cont]).toFixed(2) + '</td> <td align="right">$ ' + unitPriceWithDiscount.toFixed(2) + '</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
        } else {
            Swal.fire({
                type: 'error',
                text: 'La cantidad a vender supera el stock.',
            })
        }
     } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de la cotización.',
        })
    }     
}

function limpiar() {
    $("#quantity").val("");
    $("#discount").val("0");
    $("#price").val("");
}
function totales() {
    $("#total").html("$ " + total.toFixed(2));

    //total_impuesto = total * impuesto / 100;
    total_pagar = total;
    //$("#total_impuesto").html("USD " + total_impuesto.toFixed(2));
    $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));
}
function evaluar() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}
function eliminar(index) {
    total = total - subtotal[index];
    //total_impuesto = total * impuesto / 100;
    total_pagar_html = total;
    $("#total").html("$ " + total);
    //$("#total_impuesto").html("USD" + total_impuesto);
    $("#total_pagar_html").html("$ " + total_pagar_html);
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();
}
    
</script>

<script type="text/javascript">
        function xajax_changeColorImageAttribute(prod_option_value) {
          var i, pos;
          var sel = document.getElementById('cmbooption_1');
          var rad = document.getElementsByName('id[1]');
          for (i = 0; i < rad.length; i++) {
            if (rad[i].value == prod_option_value) {
              rad[i].checked = 'on';
 //    alert('Value: ' + rad[i].value + '\n' + 'checked: ' + rad[i].checked);
            }
          }
		  
          for (i = 0; i <sel.options.length; i++) {
	        if (sel.options[i].value == prod_option_value) {
 //    alert(sel.options[i].value);
           pos = i;
        }
      }
 
    sel.selectedIndex = pos;
  //   alert(sel.selectedIndex);
 }
 
</script>
<script>
      const dui = document.querySelector('#dui')
      dui.addEventListener('keypress', () => {
      let inputLength = dui.value.length

    // MAX LENGHT 10 dui
    if (inputLength == 8) {
        dui.value += '-'
    }
    })
    </script>

    <script>
      const phone = document.querySelector('#phone')
      phone.addEventListener('keypress', () => {
      let inputLength = phone.value.length

    // MAX LENGHT 10 dui
    if (inputLength == 4) {
        phone.value += '-'
    }
    })
    </script>


<script>
function validarDescuento() {
  var descuento = parseInt(document.getElementById("discount").value);
  if (isNaN(descuento) || descuento < 0 || descuento > 100) {
    document.getElementById("discount").setCustomValidity("El descuento debe ser un número entre 0 y 100");
  } else {
    document.getElementById("discount").setCustomValidity("");
  }
}


</script>


<script>
function handleKeyDown(event) {
  if (event.keyCode === 13) { // 13 es el código de tecla Enter
    event.preventDefault(); // Evita la acción predeterminada de la tecla Enter
  }
}
</script>
<script>
  $(document).ready(function() {
    $('.selectpicker').selectpicker();
});

</script>
@endsection
