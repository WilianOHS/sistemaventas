@extends('layouts.admin')
 @section('title','Registrar cliente')
 @section('styles')
 @endsection
 @section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Registro de clientes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de clientes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                
                {!! Form::open(['route'=>'clients.store','method'=>'POST','files'=>true, 'onsubmit'=>'sumarValores()']) !!}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="dui">DUI</label>
                        <input type="text" name="dui" id="dui" class="form-control" aria-describedby="helpId" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label for="">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                    <label for="departamento">Departamento:</label>
                        <select name="departamento" id="departamento" onchange="mostrarMunicipios()" style="width: 20%;">
                        <option value="" disabled selected>Seleccione un Departamento</option>
                        <option value="morazan">Morazán</option>
                        <option value="san-miguel">San Miguel</option>
                        <option value="la-union">La Unión</option>
                        <option value="usulutan">Usulután</option>
                        <option value="san-vicente">San Vicente</option>
                        <option value="cabañas">Cabañas</option>
                        <option value="la-paz">La Paz</option>
                        <option value="san-salvador">San Salvador</option>
                        <option value="cuscatlan">Cuscatlán</option>
                        <option value="chalatenango">Chalatenango</option>
                        <option value="la-libertad">La Libertad</option>
                        <option value="sonsonate">Sonsonate</option>
                        <option value="santa-ana">Santa Ana</option>
                        <option value="ahuachapan">Ahuachapán</option>
                        <!-- Otras opciones de departamentos -->
                        </select>

                        <label for="municipio">Municipio:</label>
                        <select id="municipio" name="municipio" style="width: 35%;">                         
                        <option value="" disabled selected>Seleccione un departamento para mostrar municipios</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefóno / Celular</label>
                        <input type="text" name="phone" id="phone" class="form-control" aria-describedby="helpId" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="9">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" aria-describedby="helpId">
                    </div>




                    <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                    <a href="{{route('clients.index')}}" class="btn btn-light">
                        Cancelar
                    </a>
                    {!! Form::close() !!}
                </div>



            </div>
        </div>
    </div>
</div>            
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
<script>
function sumarValores() {
  var direccion = document.getElementById("address").value;
  var departamento = document.getElementById("departamento").value;
  var municipio = document.getElementById("municipio").value;
  
  // Validar los valores ingresados por el usuario
  if (direccion.trim() == "" || departamento == "" || municipio == "") {
    alert("Debe ingresar una dirección completa y seleccionar un departamento y un municipio");
    return;
  }
  
  // Convertir el nombre del departamento y municipio a su versión con mayúsculas y sin caracteres especiales
  departamento = convertirNombreDepartamento(departamento);
  
  var direccionCompleta = direccion + ", " + municipio + ", " + departamento;
  
  // Actualizar el valor del input de dirección con la dirección completa
  document.getElementById("address").value = direccionCompleta;
}

function convertirNombreDepartamento(departamento) {
  switch (departamento) {
    case "morazan":
      return "Morazán";
    case "sanmiguel":
      return "San Miguel";
    case "la-union":
      return "La Unión";
    case "usulutan":
      return "Usulután";
    case "san-vicente":
      return "San Vicente";
    case "cabañas":
      return "Cabañas";
    case "la-paz":
      return "La Paz";
    case "san-salvador":
      return "San Salvador";
    case "cuscatlan":
      return "Cuscatlán";
    case "chalatenango":
      return "Chalatenango";
    case "la-libertad":
      return "La Libertad";
    case "sonsonate":
      return "Sonsonate";
    case "santa-ana":
      return "Santa Ana";
    case "ahuachapan":
      return "Ahuachapán";
    default:
      return departamento;
  }
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

    <!-- Seleccion de municipios y departamentos -->

    <script>
  function mostrarMunicipios() {
    const departamentoSeleccionado = document.getElementById("departamento").value;
    const municipios = obtenerMunicipiosPorDepartamento(departamentoSeleccionado);

    const municipioSelect = document.getElementById("municipio");
    municipioSelect.innerHTML = "";

    municipios.forEach((municipio) => {
      const option = document.createElement("option");
      option.text = municipio;
      municipioSelect.add(option);
    });
  }

  function obtenerMunicipiosPorDepartamento(departamento) {
    // Aquí debes agregar la lógica para obtener los municipios del departamento seleccionado
    // Puedes obtenerlos de un objeto JavaScript o una base de datos
    switch (departamento) {
      case "morazan":
        return ["Arambala",
                "Cacaopera",
                "Chilanga",
                "Corinto",
                "Delicias de Concepción",
                "El Divisadero",
                "El Rosario",
                "Gualococti",
                "Guatajiagua",
                "Joateca",
                "Jocoaitique",
                "Jocoro",
                "Lolotique",
                "Meanguera",
                "Osicala",
                "Perquín",
                "San Carlos",
                "San Fernando",
                "San Francisco Gotera",
                "San Isidro",
                "San Simón",
                "Sensembra",
                "Sociedad",
                "Torola",
                "Yamabal"];
      case "san-miguel":
        return ["Carolina",
                "Chapeltique",
                "Chinameca",
                "Chirilagua",
                "Ciudad Barrios",
                "Comacarán",
                "El Tránsito",
                "Lolotique",
                "Moncagua",
                "Nueva Guadalupe",
                "Nuevo Edén de San Juan",
                "Quelepa",
                "San Antonio del Mosco",
                "San Gerardo",
                "San Jorge",
                "San Luis de la Reina",
                "San Miguel",
                "San Rafael Oriente",
                "Sesori",
                "Uluazapa"
              ];
      case "la-union":
        return ["Anamorós",
                "Bolívar",
                "Concepción de Oriente",
                "Conchagua",
                "El Carmen",
                "El Sauce",
                "Intipucá",
                "La Unión",
                "Lislique",
                "Meanguera del Golfo",
                "Nueva Esparta",
                "Pasaquina",
                "Polorós",
                "San Alejo",
                "San José",
                "Santa Rosa de Lima",
                "Yayantique",
                "Yucuaiquín"];
      case "usulutan":
        return ["Alegría",
                "Berlín",
                "California",
                "Concepción Batres",
                "El Triunfo",
                "Ereguayquín",
                "Estanzuelas",
                "Jiquilisco",
                "Jucuapa",
                "Jucuarán",
                "Mercedes Umaña",
                "Nueva Granada",
                "Ozatlán",
                "Puerto El Triunfo",
                "San Agustín",
                "San Buenaventura",
                "San Dionisio",
                "San Francisco Javier",
                "Santa Elena",
                "Santa María",
                "Santiago de María",
                "Tecapán",
                "Usulután"];
      case "san-vicente":
        return ["Apastepeque",
                "Guadalupe",
                "San Cayetano Istepeque",
                "San Esteban Catarina",
                "San Ildefonso",
                "San Lorenzo",
                "San Sebastián",
                "San Vicente",
                "Santa Clara",
                "Santo Domingo",
                "Tecoluca",
                "Tepetitán",
                "Verapaz"];
      case "cabañas":
        return ["Cinquera",
                "Dolores",
                "Guacotecti",
                "Ilobasco",
                "Jutiapa",
                "San Isidro",
                "Sensuntepeque",
                "Tejutepeque",
                "Victoria"];
      case "la-paz":
        return ["Cuyultitán",
                "El Rosario",
                "Jerusalén",
                "Mercedes La Ceiba",
                "Olocuilta",
                "Paraíso de Osorio",
                "San Antonio Masahuat",
                "San Emigdio",
                "San Francisco Chinameca",
                "San Juan Nonualco",
                "San Juan Talpa",
                "San Luis Talpa",
                "San Miguel Tepezontes",
                "San Pedro Masahuat",
                "San Pedro Nonualco",
                "San Rafael Obrajuelo",
                "Santa María Ostuma",
                "Santiago Nonualco",
                "Tapalhuaca",
                "Zacatecoluca"];
      case "san-salvador":
        return ["Aguilares",
                "Apopa",
                "Ayutuxtepeque",
                "Cuscatancingo",
                "Delgado",
                "El Paisnal",
                "Guazapa",
                "Ilopango",
                "Mejicanos",
                "Nejapa",
                "Panchimalco",
                "Rosario de Mora",
                "San Marcos",
                "San Martín",
                "Santiago Texacuangos",
                "Santo Tomás",
                "Soyapango",
                "Tonacatepeque"];
      case "cuscatlan":
        return ["Candelaria",
                "Cojutepeque",
                "El Carmen",
                "El Rosario",
                "Monte San Juan",
                "Oratorio de Concepción",
                "San Bartolomé Perulapía",
                "San Cristóbal",
                "San José Guayabal",
                "San Pedro Perulapán",
                "San Rafael Cedros",
                "San Ramón",
                "Santa Cruz Analquito",
                "Santa Cruz Michapa",
                "Suchitoto",
                "Tenancingo"];
      case "chalatenango":
        return ["Agua Caliente",
                "Arcatao",
                "Azacualpa",
                "Chalatenango",
                "Citalá",
                "Comalapa",
                "Concepción Quezaltepeque",
                "Dulce Nombre de María",
                "El Carrizal",
                "El Paraíso",
                "La Laguna",
                "La Palma",
                "La Reina",
                "Las Vueltas",
                "Nueva Concepción",
                "Nueva Trinidad",
                "Ojos de Agua",
                "Potonico",
                "San Antonio de la Cruz",
                "San Antonio Los Ranchos",
                "San Fernando",
                "San Francisco Lempa",
                "San Francisco Morazán",
                "San Ignacio",
                "San Isidro Labrador",
                "San José Cancasque",
                "San José Las Flores",
                "San Luis del Carmen",
                "San Miguel de Mercedes",
                "San Rafael",
                "Santa Rita",
                "Tejutla"];
      case "la-libertad":
        return ["Antiguo Cuscatlán",
                "Chiltiupán",
                "Ciudad Arce",
                "Colón",
                "Comasagua",
                "Huizúcar",
                "Jayaque",
                "Jicalapa",
                "La Libertad",
                "Nuevo Cuscatlán",
                "Quezaltepeque",
                "Sacacoyo",
                "San José Villanueva",
                "San Juan Opico",
                "San Matías",
                "San Pablo Tacachico",
                "Talnique",
                "Tamanique",
                "Teotepeque",
                "Tepecoyo",
                "Zaragoza"];
      case "sonsonate":
        return ["Acajutla",
                "Armenia",
                "Caluco",
                "Cuisnahuat",
                "Izalco",
                "Juayúa",
                "Nahuizalco",
                "Nahulingo",
                "Salcoatitán",
                "San Antonio del Monte",
                "San Julián",
                "Santa Catarina Masahuat",
                "Santa Isabel Ishuatán",
                "Santo Domingo de Guzmán",
                "Sonsonate",
                "Sonzacate"];
      case "santa-ana":
        return ["Candelaria de la Frontera",
                "Chalchuapa",
                "Coatepeque",
                "El Congo",
                "El Porvenir",
                "Masahuat",
                "Metapán",
                "San Antonio Pajonal",
                "San Sebastián Salitrillo",
                "Santa Ana",
                "Santa Rosa Guachipilín",
                "Santiago de la Frontera",
                "Texistepeque"];
      case "ahuachapan":
        return ["Ahuachapán",
                "Apaneca",
                "Atiquizaya",
                "Concepción de Ataco",
                "El Refugio",
                "Guaymango",
                "Jujutla",
                "San Francisco Menéndez",
                "San Lorenzo",
                "San Pedro Puxtla",
                "Tacuba",
                "Turín"];
      // Agregar más departamentos
      default:
        return [];
    }
  }
</script>


@endsection
