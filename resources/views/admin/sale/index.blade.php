@extends('layouts.admin')
 @section('title','Gestion de ventas')
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
            Ventas
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ventas</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    <!-- <div class="d-flex justify-content-between">
                        <h4 class="card-title">Ventas</h4>
                          <div class="btn-group">
                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('sales.create')}}" class="dropdown-item">Registrar</a>
                          </div>
                        </div>
                    </div> -->

                  <div class="table-responsive">
                    <table id="sales_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Cliente</th>
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
                            <td>{{$sale->client->name}}</td>  
                            <td>{{\Carbon\Carbon::parse($sale->sale_date)->format('d M y h:i a')}}</td>
                            <td>$ {{$sale->total}}</td>
                            <td>{{$sale->document_type}}</td>  
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
                            <a href="{{route('sales.ticket', $sale)}}" class="btn btn-outline-danger"
                            title="Imprmit Ticket"><i class="fas fa-print"></i></a>
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
@endsection
@section('scripts')
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
            buttons: [
              @can('sales.create')
                {
                    text: '<i class="fas fa-plus"></i> Nueva Venta',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('sales.create')}}"
                    }
                }
                @endcan,
                @can('sales.exportar')
                {
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('sales.exportar')}}"
                    }
                }
                @endcan
            ]
        });
    });
</script>
@endsection
