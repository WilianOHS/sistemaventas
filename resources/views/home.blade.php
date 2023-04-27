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
<style>
		#ventas_categorias {
			width: 40%;
			margin: 0 auto;
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

    <!-- <h1>Filtrar gráfico por fechas</h1>
  <form>
    <label for="fecha-inicio">Fecha de inicio:</label>
    <input type="date" id="fecha-inicio" name="fecha-inicio">
    <label for="fecha-fin">Fecha de fin:</label>
    <input type="date" id="fecha-fin" name="fecha-fin">
    <button type="button" onclick="filtrar()">Filtrar</button>
    <button type="button" onclick="restablecer()">Restablecer</button>
  </form>
  <canvas id="grafico"></canvas> -->


    

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
                    <!-- <div class="card-content">
                      <div class="ct-chart">
                      <canvas id="ventas_diarias" height="100">
                      </canvas>
                      </div>
                    </div> -->
                    <div class="chartCard">
      <div class="chartBox">
        <canvas id="ventas_diarias" height="100"></canvas>
        Fecha Inicio: <input id="start" type="date"> Fecha Fin: <input id="end" type="date"> <button onclick="filterDate()"><i class="fa fa-filter"></i>Filtrar</button>
        <button onclick="resetDate()"><i class="fa fa-refresh"></i>Resetear</button>
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
                      <canvas id="ventas_categorias">
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

            // var varVenta=document.getElementById('ventas_diarias').getContext('2d');
            // var charVenta = new Chart(varVenta, {
            //     type: 'line',
            //     data: {
            //         labels: [<?php foreach ($ventasdia as $ventadia)
            //     {
            //         $dia = $ventadia->date;
            //         echo '"'. $dia.'",';} ?>],
            //         datasets: [{
            //             label: 'Ventas $',
            //             data: [<?php foreach ($ventasdia as $reg)
            //             {echo ''. $reg->total.',';} ?>],
            //             backgroundColor: [
            //             'rgba(255, 99, 132, 0.5)',
            //             'rgba(54, 162, 235, 0.5)',
            //             'rgba(255, 206, 86, 0.5)',
            //             'rgba(75, 192, 192, 0.5)',
            //             'rgba(153, 102, 255, 0.5)',
            //             'rgba(255, 159, 64, 0.5)'
            //         ],
            //         borderColor: [
            //             'rgba(255,99,132,1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)'
            //         ],
            //             borderWidth: 1,
            //             fill: true, 
            //         }]
            //     },
            //     // options: {
            //     //     scales: {
            //     //       yAxes: [{
            //     //         ticks: {
            //     //             stepSize: 1,
            //     //             beginAtZero:true
            //     //         }
            //     //       }]
            //     //     },
            //     //     legend: {
            //     //       display: false
            //     //     },
            //     //     elements: {
            //     //       point: {
            //     //         radius: 5
            //     //       }
            //     //     }
            //     // }
            // });

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
                options: {
                cutoutPercentage: 10
                }
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
    // setup 
	const dates = [<?php foreach ($ventasdia as $ventadia)
                {
                    $dia = $ventadia->date;
                    echo '"'. $dia.'",';} ?>];
	const datapoints = [<?php foreach ($ventasdia as $reg)
                        {echo ''. $reg->total.',';} ?>];

//   console.log(new Date('2021-11-01 00:00:00 GMT-0600'))
  const convertedDates = dates.map(date => new Date(date).setHours(0,0,0,0));
  //console.log(convertedDates)

  var varVenta=document.getElementById('ventas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Ventas $',
                        data: datapoints,
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
    // const data = {
    //   labels: dates,
    //   datasets: [{
    //     label: 'Ventas',
    //     data: datapoints,
    //     backgroundColor: [
    //                     'rgba(255, 99, 132, 0.5)',
    //                     'rgba(54, 162, 235, 0.5)',
    //                     'rgba(255, 206, 86, 0.5)',
    //                     'rgba(75, 192, 192, 0.5)',
    //                     'rgba(153, 102, 255, 0.5)',
    //                     'rgba(255, 159, 64, 0.5)'
    //                 ],
    //                 borderColor: [
    //                     'rgba(255,99,132,1)',
    //                     'rgba(54, 162, 235, 1)',
    //                     'rgba(255, 206, 86, 1)',
    //                     'rgba(75, 192, 192, 1)',
    //                     'rgba(153, 102, 255, 1)',
    //                     'rgba(255, 159, 64, 1)'
    //                 ],
    //                     borderWidth: 1,
    //                     fill: true, 
    //                 }]
    // };

    // // config 
    // const config = {
    //   type: 'line',
    //   data,
    //   options: {
    //     scales: {
    //       x: {
	// 		type: 'time',
	// 		time: {
	// 			unit: 'day'
	// 		}
	// 	  },
	// 	  y: {
    //         beginAtZero: true
    //       }
    //     }
    //   }
    // };

        // Obtener los últimos 8 elementos del array de datos
    var last8Data = charVenta.data.datasets[0].data.slice(-8);

    // Actualizar los datos del gráfico con los últimos 8 elementos
    charVenta.data.datasets[0].data = last8Data;

    // Actualizar la etiqueta de las X con los últimos 8 elementos
    charVenta.data.labels = charVenta.data.labels.slice(-8);

    // Actualizar el gráfico
    charVenta.update();

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    function filterDate() {
  const start1 = new Date(document.getElementById('start').value);
  const start = start1.setHours(0, 0, 0, 0);
  const end1 = new Date(document.getElementById('end').value);
  const end = end1.setHours(0, 0, 0, 0);

  const filterDates = convertedDates.filter(date => date >= start && date <= end);
  const filterIndexes = filterDates.map(date => convertedDates.indexOf(date));

  const filteredDataPoints = datapoints.filter((dp, i) => filterIndexes.includes(i));
  charVenta.config.data.datasets[0].data = filteredDataPoints;

  const filteredLabels = filterDates.map(date => dates[convertedDates.indexOf(date)]);
  charVenta.config.data.labels = filteredLabels;

  charVenta.update();
}
//     function resetDate(){
//   charVenta.config.data.labels  = dates;
//   charVenta.config.data.datasets[0].data = datapoints;
//   charVenta.update();
// }
function resetDate() {
  var last8Dates = dates.slice(-8);
  var last8Datapoints = datapoints.slice(-8);

  charVenta.data.labels = last8Dates;
  charVenta.data.datasets[0].data = last8Datapoints;

  charVenta.update();
}

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;

    </script>


@endsection