@extends('layouts.admin')
@section('title','Información sobre el usuario')
@section('styles')
@endsection
@section('create')

@endsection
@section('options')

@endsection
@section('preference')

@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            {{$user->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <h3>{{$user->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <div class="list-group">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" user="tab" aria-controls="home">
                                        Sobre el usuario
                                    </a>
                                    <a type="button" class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" user="tab" aria-controls="profile">Historial de compras</a>

                                    <a type="button" class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" user="tab" aria-controls="messages">Historial de ventas</a>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" user="tabpanel" aria-labelledby="list-home-list">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Información del usuario</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">

                                            <div class="form-group col-md-6">
                                                <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                                <p class="text-muted">
                                                    {{$user->name}}
                                                </p>
                                                <hr>
                                                <strong><i class="fab fa-product-hunt mr-1"></i> Roles</strong>
                                                <p class="text-muted">
                                                    @foreach ($user->roles as $role)
                                                    <a href="{{route('roles.show',$role)}}">{{$role->name}}</a>
                                                    @endforeach
                                                </p>
                                                <hr>
                                            </div>
        
                                            <div class="form-group col-md-6">
                                                <strong>
                                                    <i class="fas fa-mobile mr-1"></i>
                                                    Correo electrónico</strong>
                                                <p class="text-muted">
                                                    {{$user->email}}
                                                </p>
                                                <hr>
                                            </div>

                                            
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="list-profile" user="tabpanel" aria-labelledby="list-profile-list">
                                    
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de compras</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
    
                                            <div class="table-responsive">
                                                <table id="purchases_listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Fecha</th>
                                                            <th>Total</th>
                                                            <th>Estado</th>
                                                            <th style="width:50px;">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($user->purchases as $purchase)
                                                    <tr>
                            <th scope="row">
                              <a href="{{route('purchases.show',$purchase)}}">{{$purchase->id}}</a>
                            </th>  
                            <td>
                            {{\Carbon\Carbon::parse($purchase->purchase_date)->format('d M y h:i a')}}
                            </td>
                            <td>{{$purchase->total}}</td>  
                            @if ($purchase->status == 'VALID')
                            <td>
                            <a class="jsgrid-button btn btn-success" href="
                                {{route('change.status.purchases',$purchase)}}"
                                title="editar">
                                Activo<i class="fas fa-check"></i>
                                </a>  
                            </td>
                            @else   
                            <td>
                            <a class="jsgrid-button btn btn-danger" href="
                                {{route('change.status.purchases',$purchase)}}"
                                title="editar">
                                Desactivado <i class="fas fa-times"></i>
                                </a>  
                            </td>
                            @endif       
                            <td style="width: 20%;">


                                <!-- <button class="jsgrid-button jsgrid-delete-button unstyled-button" 
                                type="submit" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </button> -->

                                <a href="{{route('purchases.pdf',$purchase)}}" class="btn btn-outline-danger"><i class="fas fa-file-pdf"></i></a>
                                <!-- <a href="#" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-print"></i></a> -->
                                <a href="{{route('purchases.show',$purchase)}}" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
                                
        

                            </td>
                        </tr>           
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
    
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="list-messages" user="tabpanel" aria-labelledby="list-messages-list">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de ventas</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
    
                                            <div class="table-responsive">
                                                <table id="sales_listing" class="table">
                                                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Cliente</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Tipo de documento</th>
                          <th>Estado</th>
                          <th style="width: 50px;">Acciones</th>
                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($user->sales as $sale)
                        <tr>
                            <th scope="row">
                              <a href="{{route('sales.show',$sale)}}">{{$sale->id}}</a>
                            </th>
                            <td>{{$sale->client->name}}</td>  
                            <td>{{\Carbon\Carbon::parse($sale->sale_date)->format('d M y h:i a')}}</td>
                            <td>$ {{$sale->total}}</td>
                            <td>{{$sale->document_type}}</td>  
                            @if ($sale->status == 'VALID')
                            <td>
                            <a class="jsgrid-button btn btn-success" href="
                                {{route('change.status.sales',$sale)}}"
                                title="editar">
                                Activo<i class="fas fa-check"></i>
                                </a>  
                            </td>
                            @else   
                            <td>
                            <a class="jsgrid-button btn btn-danger" href="
                                {{route('change.status.sales',$sale)}}"
                                title="editar">
                                Desactivado <i class="fas fa-times"></i>
                                </a>  
                            </td>
                            @endif
                                  
                            <td style="width: 20%;">

                            <a href="{{route('sales.pdf', $sale)}}" class="btn btn-outline-danger"
                            title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                            <a href="{{route('sales.print', $sale)}}" class="btn btn-outline-warning"
                            title="Imprimir boleta"><i class="fas fa-print"></i></a>
                            <a href="{{route('sales.show', $sale)}}" class="btn btn-outline-info"
                            title="Ver detalles"><i class="far fa-eye"></i></a>
                                   
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
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('users.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#purchases_listing').DataTable({
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
                {
                }
            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#sales_listing').DataTable({
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
                {
                }
            ]
        });
    });
</script>
@endsection