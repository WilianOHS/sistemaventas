@extends('layouts.admin')
@section('title','Detalles de venta')
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
        Detalles de venta 
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> 
                <li class="breadcrumb-item"><a href="{{route('sales.index')}}">Ventas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de venta </li>
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
                            <p style="font-size: 18px">
                            @if(isset($sale->client))
                            <p style="font-size: 18px"><a href="{{route('clients.show', $sale->client)}}">{{$sale->client->name}}</a></p>
                            @else
                                Cliente Eliminado
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Vendedor</strong></label>
                            <p style="font-size: 18px">
                                @isset($sale->user)
                                    {{ $sale->user->name }}
                                @else
                                    Usuario Eliminado
                                @endisset
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Número Venta</strong></label>
                            <p style="font-size: 18px">{{$sale->id}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Tipo de documento</strong></label>
                            <p style="font-size: 18px">
                                @if($sale->document_type == 'credito_fiscal')
                                    Crédito Fiscal
                                @else
                                    {{$sale->document_type}}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Número de documento</strong></label>
                            <p style="font-size: 18px">{{$sale->document_number}}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Método de Pago</strong></label>
                            <p style="font-size: 18px">{{$sale->payment_method}}</p>
                        </div>
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <h4 class="card-title">Detalles de venta</h4>
                        <div class="table-responsive col-md-12">
                            <table id="saleDetails" class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio Venta (USD)</th>
                                        <th>Descuento(USD)</th>
                                        <th>Cantidad</th>
                                        <th>SubTotal(USD)</th>
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
                                            <p align="right">${{number_format($sale->total,2)}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">EFECTIVO RECIBIDO:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{$sale->cash}}</p>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="4">
                                            <p align="right">CAMBIO:</p>
                                        </th>
                                        <th>
                                            <p align="right">${{number_format($sale->cash - $sale->total, 2)}}</p>
                                        </th>
                                    </tr>

                                </tfoot>
                                <tbody>
                                    @foreach($saleDetails as $saleDetail)
                                    <tr>
                                        <td>{{$saleDetail->product->name}}</td>
                                        <td>$ {{$saleDetail->price}}</td>
                                        <td>{{$saleDetail->discount}} %</td>
                                        <td>{{$saleDetail->quantity}}</td>
                                        <td>${{number_format($saleDetail->quantity*$saleDetail->price - $saleDetail->quantity*$saleDetail->price*$saleDetail->discount/100,2)}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>         
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('sales.index')}}" class="btn btn-primary float-right">Regresar</a>
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