@extends('layouts.admin')
 @section('title','Gestion de compras')
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
            Compras
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compras</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Compras</h4>
                          <div class="btn-group">
                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('purchases.create')}}" class="dropdown-item">Registrar</a>
                          </div>
                        </div>
                    </div>

                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>

                        <!-- 'provider_id',
                        'user_id',
                        'purchase_date',
                        'iva',
                        'total',
                        'status',
                        'picture', -->
                          <th>Id</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($purchases as $purchase)
                        <tr>
                            <th scope="row">{{$purchase->id}}</th>  
                            <td>{{$purchase->purchase_date}}</td>
                            <td>{{$purchase->total}}</td>  
                            <td>{{$purchase->status}}</td>        
                            <td style="width:50px">
                                {!! Form::open(['route'=>['purchases.destroy',
                                $purchase], 'method'=>'DELETE']) !!}

                                <a class="jsgrid-button jsgrid-edit-button" href="
                                {{route('purchases.edit',$purchase)}}"
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
