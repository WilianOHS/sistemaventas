@extends('layouts.admin')
@section('title','Información de producto')
@section('styles')
<style>
    .img-xl {
  max-width: 100%;
  height: auto;
  width: 200px; /* ajusta el valor a lo que necesites */
  display: block;
  margin: auto;
}
</style>
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
                        @if($product->image)
                            <img src="{{ asset('image/'.$product->image) }}" alt="Imagen del producto"class="img-lg mb-3 img-xl">
                        @else
                            <img src="{{ asset('image/'.$business->logo) }}" alt="Logo de la empresa"class="img-lg mb-3 img-xl">
                        @endif
                        <h3>{{$product->name}}</h3>
                        <div class="d-flex justify-content-between">
                        </div>
                        </div>

                        <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Estado
                          </span>
                          <span class="float-right text-muted">
                            @if ($product->status == 'ACTIVE')
                                Activo
                            @else
                                Desactivado
                            @endif
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Proveedor
                            </span>
                            <span class="float-right text-muted">
                                @isset($product->provider)
                                    <a href="{{route('providers.show', $product->provider->id)}}">
                                        {{$product->provider->name}}
                                    </a>
                                @else
                                    Proveedor Eliminado
                                @endisset
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Categoría
                            </span>
                            <span class="float-right text-muted">
                                @isset($product->category)
                                    <a href="{{route('categories.show', $product->category->id)}}">
                                        {{$product->category->name}}
                                    </a>
                                @else
                                    Categoría Eliminada
                                @endisset
                            </span>
                        </p>
                      </div>        
                        @if ($product->status == 'ACTIVE')
                            <button class="btn btn-success btn-block">ACTIVO</button>
                        @else
                            <button class="btn btn-warning btn-block">DESACTIVADO</button>
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
                                <div class="form-group col-md-6">
                                        <strong><i class="fas fa-barcode mr-1"></i> Código de barras</strong>
                                        <p class="text-muted">{{$product->code}}</p>

                                        <hr>
                                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre de producto</strong>
                                        <p class="text-muted">{{$product->name}}</p>

                                        <hr>
                                        <strong><i class="fas fa-boxes mr-1"></i> Stock</strong>
                                        <p class="text-muted">{{$product->stock}}</p>

                                        <hr>
                                        <strong><i class="fas fa-dollar-sign mr-1"></i> Precio de venta</strong>
                                        <p class="text-muted">$ {{$product->sale_price}}</p>

                                        <hr>
                                        <strong><i class="fas fa-shopping-cart mr-1"></i> Detalles de Compra Relacionada</strong>
                                        @foreach ($purchaseDetails as $purchaseDetail)
                                            <p class="text-muted mb-1"><strong>Fecha:</strong> {{ $purchaseDetail->created_at->format('d/m/Y') }}</p>
                                            <p class="text-muted mb-1"><strong>Precio de Compra:</strong> ${{ $purchaseDetail->price }}</p>
                                            <p class="text-muted my-1"><strong>Cantidad:</strong> {{ $purchaseDetail->quantity }}</p>
                                            <hr>
                                        @endforeach

                                        <!-- Agregar paginación -->
                                        {{ $purchaseDetails->links() }}
                                    </div>

                                    <div class="form-group col-md-6">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <strong>
                                        <i class="fas fa-weight-hanging mr-1"></i>
                                        Peso o Cantidad
                                        </strong>
                                        <p class="text-muted">
                                        {{$product->weight}}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>
                                        <i class="fas fa-file-powerpoint mr-1"></i>
                                        Presentación
                                        </strong>
                                        <p class="text-muted">
                                        {{$product->presentation}}
                                        </p>
                                    </div>
                                    </div>
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
                                        <strong><i class="fas fa-circle-notch"></i> Marca</strong>
                                        <p class="text-muted">
                                            {{$product->marca}}
                                        </p>
                                        <hr>
                                        
                                        <strong><i class="fas fa-barcode mr-1"></i> Código de barras</strong>
                                        <p class="text-muted">
                                            {!! DNS1D::getBarcodeHTML($product->code, 'EAN13'); !!}
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