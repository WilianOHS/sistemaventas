@extends('layouts.admin')
@section('title','información de la categoría')
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
        {{$category->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Panel administrador</a></li> 
                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorías</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
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
                            <h3>{{$category->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                            <div class="list-group">
                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                        Sobre categoría
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list"
                                        data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                                        Productos
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-lg-5">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" user="tabpanel" aria-labelledby="list-home-list">
                                    <div class="d-flex justify-content-between">
                                    <div>
                                    <h4>Información de la categoría</h4>
                                </div>
                                    </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">
                                <div class="form-group col-md-6">
                                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                        <p class="text-muted">
                                            {{$category->name}}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-address-card mr-1"></i> Descripción de la categoría</strong>
                                        <p class="text-muted">
                                            {{$category->description}}
                                        </p>
                                        <hr>
                                    </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-profile" user="tabpanel"
                                    aria-labelledby="list-profile-list">
                                    <div class="d-flex justify-content-between">
                                    <div>
                                            <h4>Productos</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
    
                                        <div class="table-responsive">
                                            <table id="product_listing" class="table">
                                            <thead>
                                                <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Stock</th>
                                                <th>Estado</th>
                                                <th>Categoría</th>
                                                <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                <tr>
                                                    <th scope="row">{{$product->id}}</th>
                                                    <td>
                                                        <a href="{{route('products.show',$product)}}">{{$product->name}}</a>                                
                                                    </td>    
                                                    <td>{{$product->stock}}</td>     
                                                    @if ($product->status == 'ACTIVE')
                                                    <td>
                                                    <a class="jsgrid-button btn btn-success" href="
                                                        {{route('change.status.products',$product)}}"
                                                        title="editar">
                                                        Activo<i class="fas fa-check"></i>
                                                        </a>  
                                                    </td>
                                                    @else   
                                                    <td>
                                                    <a class="jsgrid-button btn btn-danger" href="
                                                        {{route('change.status.products',$product)}}"
                                                        title="editar">
                                                        Desactivado <i class="fas fa-times"></i>
                                                        </a>  
                                                    </td>
                                                    @endif

                                                

                                                    <td>{{$product->category->name}}</td>
                                                    <td style="width: 20%;">
                                                        {!! Form::open(['route'=>['products.destroy',
                                                        $product], 'method'=>'DELETE']) !!}

                                                        <a class="btn btn-outline-info" href="
                                                        {{route('products.edit',$product)}}"
                                                        title="editar">
                                                            <i class="far fa-edit"></i>
                                                        </a>

                                                        <button class="btn btn-outline-danger" 
                                                        type="submit" title="Eliminar">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>

                                                        {!! Form::close() !!}

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
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('categories.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/profile-demo.js') !!}
{!! Html::script('melody/js/data-table.js') !!}
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#product_listing').DataTable({
            responsive: true,
            order: [[ 0, "desc" ]],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            dom:
			"<'row'<'col-sm-2'l><'col-sm-7 text-right'B><'col-sm-3'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>", 
            buttons: []
        });
    });
</script>
@endsection