@extends('layouts.admin')
 @section('title','Gestion de clientes')
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
                  
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Clientes</h4>
                          <div class="btn-group">
                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('clients.create')}}" class="dropdown-item">Agregar</a>
                          </div>
                        </div>
                    </div>

                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
<!-- 
                            'name',
                            'dui',
                            'address',
                            'phone',
                            'email', -->
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
                                <a href="{{route('clients.show',$client)}}">{{$client->name}}</a>                                
                            </td>    
                            <td>{{$client->dui}}</td>      
                            <td>{{$client->phone}}</td>
                            <td>{{$client->email}}</td>
                            <td style="width:50px">
                                {!! Form::open(['route'=>['clients.destroy',
                                $client], 'method'=>'DELETE']) !!}

                                <a class="jsgrid-button jsgrid-edit-button" href="
                                {{route('clients.edit',$client)}}"
                                title="editar">
                                    <i class="far fa-edit"></i>
                                </a>

                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" 
                                type="submit" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </button>

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
{!! Html::script('melody/js/data-table.js') !!}
@endsection
