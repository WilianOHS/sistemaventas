@extends('layouts.admin')
 @section('title','Gestion de cotizaciones')
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
            Cotizaciones
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                    <table id="sales_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Cliente</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th style="width: 50px;">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cotizaciones as $cotizacion)
                        <tr>
                            <th scope="row">
                              @can('cotizaciones.show')
                              <a href="{{route('cotizaciones.show',$cotizacion)}}"><?php echo sprintf("%03d", $cotizacion->id); ?></a>
                              @else
                                    <span><?php echo sprintf("%03d", $cotizacion->id); ?></span>
                              @endcan
                            </th>
                            <td>
                                @if(isset($cotizacion->client))
                                    {{ $cotizacion->client->name }}
                                @else
                                    Cliente Eliminado
                                @endif
                            </td>
  
                            <td>{{\Carbon\Carbon::parse($cotizacion->cotizacion_date)->format('d M y h:i a')}}</td>
                            <td>$ {{$cotizacion->total}}</td>
 
                              
                            <td style="width: 20%;">
                            @can('cotizaciones.pdf')
                            <a href="{{ route('cotizaciones.pdf', $cotizacion) }}" class="btn btn-outline-danger"
   title="Generar PDF" onclick="showLoadingModal()">
   <i class="far fa-file-pdf"></i>
</a>

                            @endcan
                            @can('cotizaciones.show')
                            <a href="{{route('cotizaciones.show', $cotizacion)}}" class="btn btn-outline-info"
                            title="Ver detalles"><i class="far fa-eye"></i></a>
                            @endcan
          
                            </td>
                        </tr>                   
                        @endforeach
                      </tbody>
                    </table>
                  
                </div>


<!-- Modal de Cargando PDF -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- Agrega un botón de cierre (X) en la cabecera del modal -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><b>CARGANDO PDF...</b></p>
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
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
                {
                    text: '<i class="fas fa-plus"></i> Nueva Cotización',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('cotizaciones.create')}}"
                    }
                }
            ]
        });
    });
</script>
<script>
  function showLoadingModal() {
    // Muestra el modal de carga
    $('#loadingModal').modal('show');

    // Simula una espera de 1 segundo antes de ocultar el modal
    setTimeout(function() {
      $('#loadingModal').modal('hide');
    }, 1000); // 1000 milisegundos = 1 segundo
  }
</script>

@endsection
