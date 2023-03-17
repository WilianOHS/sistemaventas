@extends('layouts.admin')
 @section('title','Reporte de ventas por fecha')
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
            Reporte de ventas por fecha
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reporte de ventas por fecha</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    <div class="d-flex justify-content-between">
                        <!-- <h4 class="card-title">Reporte de ventas por fecha</h4>
                          <div class="btn-group">
                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('sales.create')}}" class="dropdown-item">Registrar</a>
                          </div>
                        </div> -->
                    </div>

                    {!! Form::open(['route'=>'report.results','method'=>'POST']) !!}
                    <div class="row">
                      <div class="col-12 col-md-3">
                        <span>Fecha inicial: <b></b></span>
                        <div class="form-group">
                            <input class="form-control" type="date" value="{{old('fecha_ini')}}" name="fecha_ini" id="fecha_ini">
                        </div>
                      </div>
                      <div class="col-12 col-md-3">
                        <span>Fecha final: <b></b></span>
                        <div class="form-group">
                            <input class="form-control" type="date" value="{{old('fecha_fin')}}" name="fecha_fin" id="fecha_fin">
                        </div>
                      </div>
                      <div class="col-12 col-md-3 text-center mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Consultar</button>
                        </div>
                      </div>

                      <div class="col-12 col-md-3 text-center">
                        <span>Total de ingresos: <b> </b></span>
                        <div class="form-group">
                        <strong>$ {{$total}}</strong>
                        </div>
                      </div>
                    </div>

                    {!! Form::close() !!}

                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Fecha</th>
                          <th>Total</th>
                          <th>Estado</th>
                          <th style="width: 50px;">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                            <th scope="row">
                              <a href="{{route('sales.show',$sale)}}">{{$sale->id}}</a>
                            </th>  
                            <td>{{$sale->sale_date}}</td>
                            <td>{{$sale->total}}</td>  
                            <td>{{$sale->status}}</td>        
                            <td style="width:50px">

                          

                                <!-- <button class="jsgrid-button jsgrid-delete-button unstyled-button" 
                                type="submit" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </button> -->

                                <a href="{{route('sales.pdf',$sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-file-pdf"></i></a>
                                <a href="{{route('sales.print',$sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-print"></i></a>
                                <a href="{{route('sales.show',$sale)}}" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-eye"></i></a>
                                
        

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

<script>
    window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1;//Obtener mes
        var dia = fecha.getDate();//obtener dia
        var anio = fecha.getFullYear();//obtener año
        if (dia<10)
        dia='0'+dia;//agrega cero si el dia es menor de 10
        if (mes<10)
        mes='0'+mes //aagrega cero si el mes menor de 10
        document.getElementById('fecha_fin').value=anio+"-"+mes+"-"+dia;
    }
</script>

@endsection
