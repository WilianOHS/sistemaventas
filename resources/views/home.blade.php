@extends('layouts.admin')
 @section('title','Panel administrador')
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
        Panel administrador
        </h3>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    
                    @foreach ($totales as $total)
                    <div class="row">
                      <div class="col-lg-6 col-xs-6">
                        <div class="card text-white bg-success">
                          <div class="card-body pb-0">
                            <div class="float-right">
                              <i class="fas fa-cart-arrow-down fa-4x"></i>
                            </div>
                            <div class="text-value h4"><strong>USD {{$total->totalcompra}} (Día actual)</strong>
                            </div>
                            <div class="h4">Compras</div>
                          </div>
                          <div class="chart-wrapper mt-3 mx-3" style="height: 35px;">
                            <a href="{{route('purchases.index')}}" class="small-box-footer h4">Compras <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                    
                  <div class="col-lg-6 col-xs-6">
                    <div class="card text-white bg-info">
                      <div class="card-body pb-0">

                        <div class="float-right">
                          <i class="fas fa-shopping-cart fa-4x"></i>
                        </div>


                        <div class="text-value h4"><strong>USD {{$total->totalventa}} (Día actual)</strong>
                        </div>
                        <div class="h4">Ventas</div>
                      </div>
                      <div class="chart-wrapper mt-3 mx-3" style="height: 35px;">
                        <a href="{{route('sales.index')}}" class="small-box-footer h4">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                    @endforeach
                    


                </div>
            </div>
        </div>
    
        <div class="row">
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="text-center">Compras - Meses</h4>
                </div>
                    <div class="card-content">
                      <div class="ct-chart">
                      <canvas id="compras">
                      </canvas>
                      </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h3 class="text-center">Ventas - Meses</h3>
                </div>
                    <div class="card-content">
                      <div class="ct-chart">
                      <canvas id="ventas">
                      </canvas>
                      </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="text-center">Ventas diarias</h4>
                </div>
                    <div class="card-content">
                      <div class="ct-chart">
                      <canvas id="ventas_diarias" height="100">
                      </canvas>
                      </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="text-center">Ventas por categorias</h4>
                </div>
                    <div class="card-content">
                      <div class="ct-chart">
                      <canvas id="ventas_categorias" height="100">
                      </canvas>
                      </div>
                    </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-heading">
                            <h4 class="card-title">Productos más vendidos </h4>
                        </div>
                    </div>
                    <div class="card-body scrollbar scroll_dark pt-0" style="max-height:350px;">
                    <div class="datatable-wrapper table-responsive">
                        <table class="table table-borderless table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Stock</th>
                                    <th>Cantidad vendida</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productosvendidos as $productosvendido)
                                <tr>
                                    <td>{{$productosvendido->id}}</td>
                                    <td>{{$productosvendido->name}}</td>
                                    <td>{{$productosvendido->code}}</td>
                                    <td><strong>{{$productosvendido->stock}}</strong> Unidades</td>
                                    <td><strong>{{$productosvendido->quantity}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('products.show',$productosvendido->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
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
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('melody/js/chart.js') !!}

<script>
    $(function(){
        var varCompra=document.getElementById('compras').getContext('2d');
    
            var charCompra = new Chart(varCompra, {
                type: 'line',
                data: {
                    labels: [<?php foreach (array_reverse($comprasmes) as $reg)
                        { 
                    
                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    $mes_traducido=strftime('%B',strtotime($reg->mes));
            
                    echo '"'. $mes_traducido.'",';} ?>],
                    datasets: [{
                        label: 'Compras $',
                        data: [<?php foreach (array_reverse($comprasmes) as $reg)
                            {echo ''. $reg->totalmes.',';} ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: true,
                    }]
                },
                
                options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                            
                            beginAtZero:true
                        }
                      }]
                    }
                }
            });

            var varVenta=document.getElementById('ventas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: [<?php foreach (array_reverse($ventasmes) as $reg)
                {
                    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    $mes_traducido=strftime('%B',strtotime($reg->mes));
                    
                    echo '"'. $mes_traducido.'",';} ?>],
                    datasets: [{
                        label: 'Ventas $',
                        data: [<?php foreach (array_reverse($ventasmes) as $reg)
                        {echo ''. $reg->totalmes.',';} ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                            
                            beginAtZero:true
                        }
                      }]
                    }  
                }
            });

            var varVenta=document.getElementById('ventas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia)
                {
                    $dia = \Carbon\Carbon::parse($ventadia->date)->format('d M Y');
                    echo '"'. $dia.'",';} ?>],
                    datasets: [{
                        label: 'Ventas $',
                        data: [<?php foreach ($ventasdia as $reg)
                        {echo ''. $reg->total.',';} ?>],
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                        borderWidth: 1,
                        fill: true, 
                    }]
                },
                // options: {
                //     scales: {
                //       yAxes: [{
                //         ticks: {
                //             stepSize: 1,
                //             beginAtZero:true
                //         }
                //       }]
                //     },
                //     legend: {
                //       display: false
                //     },
                //     elements: {
                //       point: {
                //         radius: 5
                //       }
                //     }
                // }
            });

            var varVenta=document.getElementById('ventas_categorias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'doughnut',
                data: {
                    labels: [<?php foreach ($productoscategorias as $productoscategoria)
                {
                    $name= $productoscategoria->name;
                    //$cname= $productoscategoria->category_id;
                    
                    echo '"'. $name. '",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($productoscategorias as $reg)
                        {echo ''. $reg->quantity.',';} ?>],
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                        borderWidth: 1,
                        fill: true, 
                    }]
                },
                // options: {
                //     scales: {
                //       yAxes: [{
                //         ticks: {
                            
                //             beginAtZero:true
                //         }
                //       }]
                //     }  
                // }
            });
            
    });
</script>

@endsection