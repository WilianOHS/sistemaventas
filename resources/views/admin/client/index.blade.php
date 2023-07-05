@extends('layouts.admin')
 @section('title','Gestion de clientes')
 @section('styles')
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
 @endsection
 @section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Clientes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  

                  <div class="table-responsive">
                    <table id="clients_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>DUI</th>
                          <th>Telefóno / Celular</th>
                          <th>Correo electrónico</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <th scope="row">{{$client->id}}</th>
                            <td>
                                @can('clients.show')
                                <a href="{{route('clients.show',$client)}}">{{$client->name}}</a> 
                                @else
                                    <span>{{$client->name}}</span>
                                @endcan                                
                            </td>    
                            <td>{{$client->dui}}</td>      
                            <td>{{$client->phone}}</td>
                            <td>{{$client->email}}</td>
                            <td style="width: 20%;">
                                {!! Form::open(['route'=>['clients.destroy',
                                $client], 'method'=>'DELETE']) !!}
                                @can('clients.edit')
                                <a class="btn btn-outline-info" href="
                                {{route('clients.edit',$client)}}"
                                title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>
                                @can('clients.destroy')
                                @endcan
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
        var table = $('#clients_listing').DataTable({
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
                @can('clients.create')
                {
                    text: '<i class="fas fa-plus"></i> Nuevo',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('clients.create')}}"
                    }
                }
                @endcan
            ]
        });
    });
</script>
@endsection
