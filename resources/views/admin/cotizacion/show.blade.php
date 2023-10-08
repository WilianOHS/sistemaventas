@extends('layouts.admin')
@section('title','Detalles de cotización')
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
        Detalles de cotización 
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> 
                <li class="breadcrumb-item"><a href="{{route('cotizaciones.index')}}">Cotizaciones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de cotización </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="form-group row">
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Cliente</strong></label>
                            
                            @if(isset($cotizacion->client))
                            <p style="font-size: 18px"><a href="{{route('clients.show', $cotizacion->client)}}">{{$cotizacion->client->name}}</a></p>
                            @else
                            <p style="font-size: 18px">
                                Cliente Eliminado
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Vendedor</strong></label>
                            <p style="font-size: 18px">
                                @isset($cotizacion->user)
                                    {{ $cotizacion->user->name }}
                                @else
                                    Usuario Eliminado
                                @endisset
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Número Cotización</strong></label>
                            <p style="font-size: 18px">{{$cotizacion->id}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Fecha Cotización</strong></label>
                            <p style="font-size: 18px">{{\Carbon\Carbon::parse($cotizacion->cotizacion_date)->format('d M y h:i a')}}</p>
                        </div>
     
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <h4 class="card-title">Detalles de cotización</h4>
                        <div class="table-responsive col-md-12">
                            <table id="cotizacionDetails" class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Descuento(%)</th>
                                        <th>Cantidad</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">SUBTOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($subtotal,2)}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">TOTAL:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($cotizacion->total,2)}}</p>
                                        </th>
                                    </tr>

                                </tfoot>
                                <tbody>
                                    @foreach($cotizacionDetails as $cotizacionDetail)
                                    <tr>
                                        <td>{{$cotizacionDetail->product->name}}</td>
                                        <td>$ {{$cotizacionDetail->price}}</td>
                                        <td>{{$cotizacionDetail->discount}} %</td>
                                        <td>{{$cotizacionDetail->quantity}}</td>
                                        <td>${{number_format($cotizacionDetail->quantity*$cotizacionDetail->price - $cotizacionDetail->quantity*$cotizacionDetail->price*$cotizacionDetail->discount/100,2)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>         
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('cotizaciones.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/profile-demo.js') !!}
{!! Html::script('melody/js/data-table.js') !!}
@endsection