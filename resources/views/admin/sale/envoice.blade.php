<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Factura</title>
    <style>
  .visually-hidden {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  .bottom-fixed{
    position: fixed;
    bottom: 130px;
font-size: 20px;
}
.bottom-fixedd{
    position: fixed;
    bottom: 130px;
font-size: 20px;
width: 80px;
}
.bottom-fixedt{
    position: fixed;
    bottom: 60px;
font-size: 20px;
width: 80px;
}
.bottom-fixedc{
    position: fixed;
    bottom: -58px;
font-size: 20px;
width: 80px;
}
.espacio-superior {
    margin-top: 100px; 
  }
</style>
</head>
<body>
	<header>
        <div>
<p class="espacio-superior"></p>
            <pre style="font-size: 30px; line-height: 0.5;"><strong> 	  	 	</strong> {{\Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y')}}</pre>

        @isset($sale->client)
            <pre style="font-size: 20px; line-height: 0.5;"><strong>     </strong> {{$sale->client->name}}</pre>
            <pre style="font-size: 20px; line-height: 0.8;"><strong>       </strong> {{$sale->client->address}}</pre>
            <pre style="font-size: 26px; line-height: 0;"><strong>				</strong> {{$sale->client->dui}}</pre>
        @else
            <p>Cliente Eliminado</p>
        @endisset
		</div>
	</header>
  <script>
    // Espera a que se cargue completamente la página
    window.addEventListener("load", function() {
        // Activa la función de impresión
        window.print();
    });
</script>

<br>
	<section>
		<table>
			<thead>
            <tr>
      <th style="width: 22px;"><span class="visually-hidden">Cantidad</span></th>
      <th style="width: 350px;"><span class="visually-hidden">Producto</span></th>
      <th style="width: 45px;"><span class="visually-hidden">Precio</span></th>
      <th style="width: 43px;"></th>
      <th style="width: 43px;"></th>
      <th style="width: 80px;"><span class="visually-hidden">Subtotal</span></th>
    </tr>
			</thead>
			<tbody>
            @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td style="font-size: 18px; width: 26px;">{{$saleDetail->quantity}}</td>
                        <td style="font-size: 18px; width: 350px;">{{$saleDetail->product->name}}</td>
                        <td  style="font-size: 18px; width: 45px;">$ {{$saleDetail->price}}</td>
			                  <td style="width: 43px;"> </td>
			                  <td style="width: 43px;"> </td>
                        <td style="font-size: 20px; width: 80px;">$ {{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                        </td>
                    </tr>
                    @endforeach
			</tbody>
            
			<tfoot>
				<tr>
					
                </tfoot>
				<td colspan="1"></td>
				<td class="bottom-fixed" id="total-cell"> {{number_format($sale->total, 2)}}</td>
				<td colspan="3"></td>
				<td class="bottom-fixedd">$ {{number_format($sale->total, 2)}}</td>
				<td class="bottom-fixedt">$ {{number_format($sale->total, 2)}}</td>
				<td class="bottom-fixedc">$ {{number_format($sale->total, 2)}}</td>
			</tr>
		</table>
	</section>
</body>
<script>
function convertirNumeroEnLetras(numero) {
  const unidades = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
  const decenas = ["", "diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
  const especiales = ["diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve"];

  let letras = "";

  if (numero >= 1000) {
    if (numero === 1000) {
      letras += "mil ";
    } else {
      letras += convertirNumeroEnLetras(Math.floor(numero / 1000)) + " mil ";
    }
    numero %= 1000;
  }

  if (numero >= 100) {
    if (numero === 100) {
      letras += "cien ";
    } else {
      const centenas = Math.floor(numero / 100);
      letras += unidades[centenas] + "cientos ";
      numero %= 100;
    }
  }

  if (numero >= 20) {
    letras += decenas[Math.floor(numero / 10)];
    if (numero % 10 !== 0) {
      letras += " y " + unidades[numero % 10];
    }
  } else if (numero >= 10) {
    letras += especiales[numero - 10];
  } else if (numero > 0) {
    letras += unidades[numero];
  }

  // Utilizar una expresión regular para reemplazar todas las instancias de "unocientos"
  letras = letras.replace(/unocientos/g, "ciento");

    // Utilizar una expresión regular para reemplazar todas las instancias de "uno mil"
    letras = letras.replace(/uno mil/g, "mil");

  // Corregir "diez y uno" a "once"
  letras = letras.replace("diez y uno", "once");

  return letras;
}

const totalCell = document.getElementById("total-cell");
const totalTexto = totalCell.textContent.trim(); // Eliminar espacios en blanco

// Eliminar cualquier carácter que no sea un dígito o un punto decimal
const totalNumerico = parseFloat(totalTexto.replace(/[^0-9.]/g, ''));

const totalEntero = Math.floor(totalNumerico);
const centavos = Math.round((totalNumerico - totalEntero) * 100);
const centavosEnLetras = centavos === 0 ? "con 00/100" : "con " + centavos + "/100";

const totalEnLetras = convertirNumeroEnLetras(totalEntero);

totalCell.textContent = totalEnLetras + " " + centavosEnLetras + " dólares " ;
</script>
</html>