@extends('layouts.admin')
 @section('title','Registrar proveedor')
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
            Registro de proveedores
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('providers.index')}}">Proveedores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de proveedores</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                   
                    {!! Form::open(['route'=>'providers.store','method'=>'POST']) !!}
                    
                    <!-- 'name', 'email','nit_number', 'address','phone',  -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailhelpId" placeholder="ejemplo@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="nit_number">Numero de NIT</label>
                        <input type="text" class="form-control" name="nit_number" id="nit_number" aria-describedby="helpId"   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="14" oninput="formatNIT(this)">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Numero de contacto</label>
                        <input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpId" required>
                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                    <a href="{{route('providers.index')}}" class="btn btn-light">
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
		function formatNIT(nitField) {
			// Remover cualquier guión existente
			let nit = nitField.value.replace(/-/g, '');

			// Agregar guiones después de ciertos números
			if (nit.length > 4) {
				nit = nit.substring(0, 4) + '-' + nit.substring(4);
			}
			if (nit.length > 11) {
				nit = nit.substring(0, 11) + '-' + nit.substring(11);
			}

			// Asignar el valor formateado al campo del NIT
			nitField.value = nit;
		}
	</script>
@endsection
