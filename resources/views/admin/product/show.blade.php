@extends('layouts.admin')
@section('title','información de producto')
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
        {{$product->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> 
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
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

                            <img src="{{asset('image/'.$product->image)}}" alt="profile" class="img-lg mb-3"/>

                                <h3>{{$product->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                        <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right text-muted">
                          {{$product->status}}
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Proveedor
                          </span>
                          <span class="float-right text-muted">
                            <a href="{{route('providers.show',$product->provider->id)}}">
                          {{$product->provider->name}}
                            </a>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Categoría
                          </span>
                            <!-- PRODUCTOS POR CATEGORIA -->
                          <span class="float-right text-muted">
                            <a href="">
                            {{$product->category->name}}
                            </a>
                          </span>
                        </p>
                        <!-- <p class="clearfix">
                          <span class="float-left">
                            Facebook
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                        </p> -->
                        <!-- <p class="clearfix">
                          <span class="float-left">
                            Twitter
                          </span>
                          <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                        </p> -->
                      </div>
                            <!-- <div class="border-bottom py-4">
                                <div class="list-group">
                                    <button type="button" class="list-group-item list-group-item-action active">
                                        Sobre producto
                                    </button>
                                    <button type="button"
                                        class="list-group-item list-group-item-action">Productos</button>
                                    <button type="button" class="list-group-item list-group-item-action">Registrar
                                        producto</button>
                                </div>
                            </div> -->
                            
                            @if ($product->status == 'ACTIVE')
                            <button class="btn btn-success btn-block">{{$product->status}}</button>
                            @else
                            <button class="btn btn-warning btn-block">{{$product->status}}</button>
                            @endif
                        </div>      
                        <div class="col-lg-8 pl-lg-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Información de producto</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">
                                    <!-- 
                                    'code', 'name', 'stock', 'image', 'price', 'sale_price',
                                    'presentation', 'weight', 'year', 'model', 'status', 'category_id',
                                    'provider_id',  -->

                                   

                                    <div class="form-group col-md-6">
                                        <strong><i class="fas fa-code mr-1"></i> Código</strong>
                                        <p class="text-muted">
                                            {{$product->code}}
                                        </p>
                                        <hr>
                                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre de producto</strong>
                                        <p class="text-muted">
                                            {{$product->name}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-boxes mr-1"></i> Stock</strong>
                                        <p class="text-muted">
                                            {{$product->stock}}
                                        </p>
                                        <hr>
                                        <!-- <strong><i class="fas fa-money-bill mr-1"></i> Precio de compra</strong>
                                        <p class="text-muted">
                                            {{$product->price}}
                                        </p>
                                        <hr> -->
                                        <strong><i class="fas fa-dollar-sign mr-1"></i> Precio de venta</strong>
                                        <p class="text-muted">
                                            {{$product->sale_price}}
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong><i class="fas fa-file-powerpoint mr-1"></i> Presentación</strong>
                                        <p class="text-muted">
                                            {{$product->presentation}}
                                        </p>
                                        <strong>
                                            <i class="fas fa-weight-hanging mr-1"></i>
                                            Peso</strong>
                                        <p class="text-muted">
                                            {{$product->weight}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-calendar-check mr-1"></i> Año</strong>
                                        <p class="text-muted">
                                            {{$product->year}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-square mr-1"></i> Modelo</strong>
                                        <p class="text-muted">
                                            {{$product->model}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-square mr-1"></i> Marca</strong>
                                        <p class="text-muted">
                                            {{$product->marca}}
                                        </p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('products.index')}}" class="btn btn-primary float-right">Regresar</a>
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