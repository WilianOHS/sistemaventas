@extends('layouts.admin')
 @section('title','Editar cliente')
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
            Edición de clientes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edición de clientes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    
                    {!! Form::model($client,['route'=>['clients.update',$client],'method'=>'PUT','files'=> true]) !!}
                    
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="{{$client->name}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="dui">DUI</label>
                        <input type="text" name="dui" id="dui" value="{{$client->dui}}" class="form-control" aria-describedby="helpId" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label for="nit">NIT</label>
                        <input type="text" name="nit" id="nit" value="{{$client->nit}}" class="form-control" aria-describedby="helpId"   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="16" oninput="formatNIT(this)">
                    </div>

                    <div class="form-group">
                        <label for="nrc">NRC</label>
                        <input type="text" name="nrc" id="nrc" value="{{$client->nrc}}" class="form-control" aria-describedby="helpId" pattern="\d{6}-\d{1}" title="Formato: 000000-0" maxlength="8">
                    </div>

                    <div class="form-group">
                        <label for="giro">Giro</label>
                        <input type="text" name="giro" id="giro" value="{{$client->giro}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" id="address" value="{{$client->address}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefóno / Celular</label>
                        <input type="text" name="phone" id="phone"  value="{{$client->phone}}" class="form-control" aria-describedby="helpId" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="9">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email"  value="{{$client->email}}" class="form-control" aria-describedby="helpId">
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Editar</button>
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
{!! Html::script('melody/js/dropify.js') !!}
<script>
		function formatNIT(nitField) {
        // Remover cualquier guión existente
        let nit = nitField.value.replace(/-/g, '');

        // Agregar guiones después de ciertos números
        if (nit.length > 4) {
            nit = nit.substring(0, 4) + '-' + nit.substring(4);
        }
        if (nit.length > 10) {
            nit = nit.substring(0, 10) + '-' + nit.substring(10);
        }
        if (nit.length > 14) {
            nit = nit.substring(0, 14) + '-' + nit.substring(14);
        }
        if (nit.length > 16) {
            nit = nit.substring(0, 16);
        }

        // Asignar el valor formateado al campo del NIT
        nitField.value = nit;
        }
</script> 
<script>
    // Función para agregar guiones automáticamente al campo NRC mientras se escribe
    document.getElementById('nrc').addEventListener('input', function (e) {
        let input = e.target;
        let value = input.value.replace(/\D/g, '');
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,6}', 'g')).join('-');
        }
        input.value = value;
    });
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
@endsection
