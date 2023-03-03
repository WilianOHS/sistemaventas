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
                  
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edición de producto</h4>    
                    </div>
                    {!! Form::model($product,['route'=>['products.update',$product],'method'=>'PUT','files'=> true]) !!}
                    
                    <!-- 'code', 'name', 'stock', 'image', 'price', 'sale_price',
        'presentation', 'weight', 'year', 'model', 'status', 'category_id',
        'provider_id',  -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" name="price" id="price"  value="{{$product->price}}"  class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Precio de venta</label>
                        <input type="number" name="sale_price" id="sale_price" value="{{$product->sale_price}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="presentation">Presentación</label>
                        <input type="text" name="presentation" id="presentation" value="{{$product->presentation}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <input type="number" name="weight" id="weight" value="{{$product->weight}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="number" name="year" id="year" value="{{$product->year}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="model">Modelo</label>
                        <input type="text" name="model" id="model"  value="{{$product->model}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select id="category_id" class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                            @if ($category->id == $product->category_id)
                            selected
                            @endif
                            >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <select id="provider_id" class="form-control" name="provider_id">
                            @foreach ($providers as $product)
                            <option value="{{$product->id}}"
                            @if ($product->id == $product->provider_id)
                            selected
                            @endif
                            >{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="custom-file mb-4">
                        <input type="file" class="custom-file-input" name="image" id="image" lang="es">
                        <label class="custom-file-label" for="image">Seleccionar Archivo</label>
                    </div> -->

                    <div class="card-body">
                        <h4 class="card-title d-flex">Imagen de producto
                            <small class="ml-auto align-self-end">
                            <a href="dropify.html" class="font-weight-light" target="_blank">Seleccionar Archivo</a>
                            </small>
                        </h4>
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
