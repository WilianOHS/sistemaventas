@extends('layouts.admin')
 @section('title','Editar producto')
 @section('styles')
 @endsection
 @section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Edición de productos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edición de productos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    {!! Form::model($product,['route'=>['products.update',$product],'method'=>'PUT','files'=> true]) !!}
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="code">Código de barra</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{$product->code}}"  aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Precio de venta</label>
                        <input type="number" name="sale_price" id="sale_price" value="{{$product->sale_price}}" class="form-control" aria-describedby="helpId" step=".01" required>
                    </div>

                    <div class="form-group">
                        <label for="presentation">Presentación</label>
                        <input type="text" name="presentation" id="presentation" value="{{$product->presentation}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="weight">Peso o cantidad</label>
                        <input type="number" name="weight" id="weight" value="{{$product->weight}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="number" name="year" id="year" value="{{$product->year}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="model">Modelo</label>
                        <input type="text" name="model" id="model" value="{{$product->model}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" value="{{$product->marca}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select id="category_id" class="form-control" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($category->id == $product->category_id)
                                        selected
                                    @endif
                                >
                                    @isset($category->name)
                                        {{$category->name}}
                                    @else
                                        Categoría Eliminada
                                    @endisset
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <select id="provider_id" class="form-control" name="provider_id">
                            @foreach ($providers as $provider)
                                <option value="{{$provider->id}}"
                                    @if ($provider->id == $product->provider_id)
                                        selected
                                    @endif
                                >
                                    @isset($provider->name)
                                        {{$provider->name}}
                                    @else
                                        Proveedor Eliminado
                                    @endisset
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                    <h4 class="card-title d-flex">Imagen de producto
                        <small class="ml-auto align-self-end"></small>
                    </h4>
                    @if ($product->image)
                        <img src="{{asset('image/'.$product->image)}}" alt="profile" class="img-lg mb-3"/>
                    @endif
                    <input type="file" name="picture" id="picture" class="dropify" />
                </div>

                    <button type="submit" class="btn btn-primary mr-2">Editar</button>
                    <a href="{{route('products.index')}}" class="btn btn-light">
                        Cancelar
                    </a>
                    {!! Form::close() !!}
                </div>



            </div>
        </div>
    </div>
</div>            
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('melody/js/dropify.js') !!}
@endsection
