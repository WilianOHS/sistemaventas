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
.bottom-fixed{
    position: fixed;
    bottom: 410px;
font-size: 12px;
}
.bottom-fixedd{
    position: fixed;
    bottom: 385px;
font-size: 12px;
}
.bottom-fixedt{
    position: fixed;
    bottom: 365px;
font-size: 12px;
}
.bottom-fixedc{
    position: fixed;
    bottom: 270px;
font-size: 12px;
}
.espacio-superior {
    margin-top: 132px; 
  }
</style>
</head>
<body>
	<header>
        <div>
<p class="espacio-superior"></p>
            <pre style="font-size: 20px; line-height: 0.5;"><strong> 	  	 	</strong> {{\Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y')}}</pre>

        @isset($sale->client)
            <pre style="font-size: 12px; line-height: 0.5;"><strong>     </strong> {{$sale->client->name}}</pre>

<div style="display: flex;">
	<div style="width: 56px;">
  
    </div>
    <div style="width: 207px; padding-right: 20px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
        {{$sale->client->address}}
    </div>
<div style="width: 56px;">
  
    </div>
    <div style="width: 132px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        {{$sale->client->nrc}}
    </div>
</div>


<div style="display: flex;">
	<div style="width: 56px;">
  
    </div>
    <div style="width: 207px; padding-right: 20px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
        {{$sale->client->departamento}}
    </div>
<div style="width: 10px;">
  
    </div>
    <div style="width: 170px; font-size: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        {{$sale->client->giro}}
    </div>
</div>

<div style="display: flex;">
	<div style="width: 56px;">
  
    </div>
    <div style="width: 207px; padding-right: 20px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
        {{$sale->client->dui}}
    </div>
<div style="width: 56px;">
  
    </div>
    <div style="width: 132px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        
    </div>
</div>
<br>

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
<br><br>
	<section>
		<table>
			<thead>
            <tr>
      <th style="width: 14px;"><span class="visually-hidden">Cantidad</span></th>
      <th style="width: 260px;"><span class="visually-hidden">Producto</span></th>
      <th style="width: 37px;"><span class="visually-hidden">Precio</span></th>
      <th style="width: 37px;"></th>
      <th style="width: 37px;"></th>
      <th style="width: 37px;"><span class="visually-hidden">Subtotal</span></th>
    </tr>
			</thead>
			<tbody>
            @foreach ($saleDetails as $saleDetail)
                    <tr>
                        <td style="font-size: 10px; width: 14px;">{{$saleDetail->quantity}}</td>
                        <td style="font-size: 10px; width: 260px;">{{$saleDetail->product->name}}</td>
                        <td  style="font-size: 10px; width: 37px;">$ {{ number_format(($saleDetail->price) / 1.13, 2) }}</td>
			<td style="width: 37px;"> </td>
			<td style="width: 37px;"> </td>
                        <td style="font-size: 12px; width: 37px;">$ {{ number_format(($saleDetail->quantity * $saleDetail->price - $saleDetail->quantity * $saleDetail->price * $saleDetail->discount / 100) / 1.13, 2) }}
                        </td>
                    </tr>
                    @endforeach
			</tbody>
            
			<tfoot>
				<tr>
					
                </tfoot>
				
				<td class="bottom-fixedd" id="total-cell">$ {{number_format($sale->total, 2)}}</td>
				<td colspan="3"></td><td class="bottom-fixed">$ {{ number_format($sale->total / 1.13, 2) }}</td>
				<td class="bottom-fixedd">$ {{ number_format(($sale->total / 1.13) * 0.13, 2) }}</td>
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

totalCell.textContent = totalEnLetras + " " + centavosEnLetras+ " dólares ";
</script>
  <script>
function extraerDepartamento(direccion) {
    // Lista de nombres de departamentos de El Salvador
    const departamentos = ["San Salvador", "Santa Ana", "San Miguel", "La Libertad", "Usulután", "Cuscatlán", "La Paz", "Chalatenango", "Sonsonate", "Ahuachapán", "Morazán", "Cabañas", "La Unión"];

    // Convierte la dirección a minúsculas para hacer coincidencias sin importar las mayúsculas
    const direccionMinusculas = direccion.toLowerCase();

    // Busca si alguno de los nombres de departamentos está presente en la dirección
    const departamentoEncontrado = departamentos.find(depto => direccionMinusculas.includes(depto.toLowerCase()));

    // Si se encontró un departamento, lo devuelve; de lo contrario, devuelve una cadena vacía
    return departamentoEncontrado || "";
}

// Ejemplo de uso
const direccion = "14 calle oriente Barrio San Francisco, San Miguel, san-miguel";
const departamento = extraerDepartamento(direccion);

// Imprimir el departamento
console.log(departamento); // Esto mostrará "San Miguel" en la consola
</script>

</html>