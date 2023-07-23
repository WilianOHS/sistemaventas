@extends('layouts.admin')
@section('title','información del cliente')
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
        {{$client->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> 
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$client->name}}</li>
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
                                <h3>{{$client->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                            <div class="list-group">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                        Sobre cliente
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list"
                                        data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                                        Historial de compras
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" user="tabpanel" aria-labelledby="list-home-list">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Información de cliente</h4>
                                        </div>
                                    </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="form-group col-md-6">
                                        <strong><i class="fas fa-user mr-1"></i> Nombre</strong>
                                        <p class="text-muted">
                                            {{$client->name}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-address-card mr-1"></i> Número de DUI</strong>
                                        <p class="text-muted">
                                            {{$client->dui}}
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong>
                                            <i class="fas fa-map-marked-alt mr-1"></i>
                                            Dirección</strong>
                                        <p class="text-muted">
                                            {{$client->address}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-mobile mr-1"></i> Telefóno / Celular</strong>
                                        <p class="text-muted">
                                            {{$client->phone}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-envelope mr-1"></i> Correo electrónico</strong>
                                        <p class="text-muted">
                                            {{$client->email}}
                                        </p>
                                        <hr>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-profile" user="tabpanel"
                                    aria-labelledby="list-profile-list">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de compras</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
    
                                        <div class="table-responsive">
                                            <table id="sales_listing" class="table">
                                            <thead>
                                                <tr>
                                                <th>Id</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Tipo de documento</th>
                                                @can('change.status.sales')
                                                <th>Estado</th>
                                                @endcan
                                                <th style="width: 50px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales as $sale)
                                                <tr>
                                                    <th scope="row">
                                                    @can('sales.show')
                                                    <a href="{{route('sales.show',$sale)}}">{{$sale->id}}</a>
                                                    @else
                                                            <span>{{$sale->id}}</span>
                                                    @endcan
                                                    </th>
                        
                                                    <td>{{\Carbon\Carbon::parse($sale->sale_date)->format('d M y h:i a')}}</td>
                                                    <td>$ {{$sale->total}}</td>
                                                    <td>
                                                        @if($sale->document_type == 'credito_fiscal')
                                                            Crédito Fiscal
                                                        @else
                                                            {{$sale->document_type}}
                                                        @endif
                                                    </td>
                        
                                                    @can('change.status.sales')
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
                                                    @endcan   
                                                    <td style="width: 20%;">
                                                    @can('sales.pdf')
                                                    <a href="{{route('sales.pdf', $sale)}}" class="btn btn-outline-danger"
                                                    title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                                                    @endcan
                                                    @can('sales.print')
                                                    <!-- <a href="{{route('sales.print', $sale)}}" class="btn btn-outline-warning"
                                                    title="Imprimir boleta"><i class="fas fa-print"></i></a> -->
                                                    @endcan
                                                    @can('sales.show')
                                                    <a href="{{route('sales.show', $sale)}}" class="btn btn-outline-info"
                                                    title="Ver detalles"><i class="far fa-eye"></i></a>
                                                    @endcan
                                                    @can('sales.print')
                                                    @if($sale->document_type == 'Ticket')
                                                        <a href="{{route('sales.ticket', $sale)}}" class="btn btn-outline-danger" title="Imprimir Ticket">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    @endif
                                                    @if($sale->document_type == 'Factura')
                                                        <a href="{{route('sales.envoice', $sale)}}" class="btn btn-outline-danger" title="Imprimir Factura">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    @endif
                                                    @if($sale->document_type == 'credito_fiscal')
                                                        <a href="{{route('sales.tax_credit', $sale)}}" class="btn btn-outline-danger" title="Imprimir Crédito Fiscal">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    @endif
                                                    @endcan    
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
                    <a href="{{route('clients.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/profile-demo.js') !!}
{!! Html::script('melody/js/data-table.js') !!}
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
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
            buttons: []
        });
    });
</script>
@endsection