@extends('layouts.admin')
 @section('title','Gestion de proveedores')
 @section('styles')
 <style type="text/css">
  .unstyled-button {
    border: none;
    padding: 0;
    background:none;
  }
</style>
 @endsection
 @section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Proveedores
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  

                  <div class="table-responsive">
                    <table id="providers_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Correo electrónico</th>
                          <th>Teléfono/Celular</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($providers as $provider)
                        <tr>
                            <th scope="row">{{$provider->id}}</th>
                            <td>
                                @can('providers.show')
                                <a href="{{route('providers.show',$provider)}}">{{$provider->name}}</a> 
                                @else
                                    <span>{{$provider->name}}</span>
                                @endcan                               
                            </td>    
                            <td>{{$provider->email}}</td>      
                            <td>{{$provider->phone}}</td>
                            <td style="width: 20%;">
                            {!! Form::open(['route'=>['providers.destroy', $provider], 'method'=>'DELETE', 'onsubmit' => 'return confirm("¿Estás seguro de que deseas eliminar este proveedor?")']) !!}
                                @can('providers.edit')
                                <a class="btn btn-outline-info" href="
                                {{route('providers.edit',$provider)}}"
                                title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>                                
                                @endcan
                                @can('providers.destroy')
                                <button class="btn btn-outline-danger" 
                                type="submit" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @endcan
                                {!! Form::close() !!}

                            </td>
                        </tr>                   
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>



            </div>
        </div>
    </div>
</div>            
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
{!! Html::script('js/my_functions.js') !!}
<script>
    $(document).ready(function() {
        var table = $('#providers_listing').DataTable({
            responsive: true,
            order: [[ 0, "desc" ]],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            dom:
			"<'row'<'col-sm-2'l><'col-sm-7 text-right'B><'col-sm-3'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>", 
            buttons: [
                @can('providers.create')
                {
                    text: '<i class="fas fa-plus"></i> Nuevo',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('providers.create')}}"
                    }
                }
                @endcan
            ]
        });
    });
</script>
@endsection
