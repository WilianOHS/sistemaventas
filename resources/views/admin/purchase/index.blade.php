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
                  

                  <div class="table-responsive">
                    <table id="purchases_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          @can('change.status.purchases')
                          <th>Estado</th>
                          @endcan
                          <th style="width: 50px;">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($purchases as $purchase)
                        <tr>
                            <th scope="row">
                            @can('purchases.show')
                              <a href="{{route('purchases.show',$purchase)}}">{{$purchase->id}}</a>
                              @else
                                    <span>{{$purchase->id}}</span>
                              @endcan
                            </th>  
                            <td>
                            {{\Carbon\Carbon::parse($purchase->purchase_date)->format('d M y h:i a')}}
                            </td>
                            <td>{{$purchase->total}}</td>  
                            @can('change.status.purchases')
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
                            @endcan     
                            <td style="width: 20%;">
                            @can('purchases.pdf')
                            <a href="{{route('purchases.pdf',$purchase)}}" class="btn btn-outline-danger"><i class="fas fa-file-pdf"></i></a>
                            @endcan  
                            @can('purchases.show')
                            <a href="{{route('purchases.show',$purchase)}}" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
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
                @can('purchases.create')
                {
                    text: '<i class="fas fa-plus"></i> Nuevo',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('purchases.create')}}"
                    }
                }
                @endcan
            ]
        });
    });
</script>
@endsection
