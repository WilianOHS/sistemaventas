@extends('layouts.admin')
 @section('title','Gestion de productos')
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
            Productos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">               
                  <div class="table-responsive">
                    <table id="product_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Stock</th>
                          @can('change.status.products') 
                          <th>Estado</th>
                          @endcan
                          <th>Categoría</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>
                                @can('product.show')
                                <a href="{{route('products.show',$product)}}">{{$product->name}}</a>  
                                @else
                                    <span>{{$product->name}}</span>
                                @endcan                               
                            </td>    
                            <td>{{$product->stock}}</td> 
                            @can('change.status.products') 
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
                            @endcan
                            <td>{{$product->category->name}}</td>
                            <td style="width: 20%;">
                            {!! Form::open(['route'=>['products.destroy', $product], 'method'=>'DELETE', 'id' => 'delete-product-form-' . $product->id]) !!}
                                @can('product.edit') 
                                <a class="btn btn-outline-info" href="
                                {{route('products.edit',$product)}}"
                                title="editar">
                                    <i class="far fa-edit"></i>
                                </a>
                                @endcan
                                @can('product.destroy') 
                                <button class="btn btn-outline-danger" type="button" title="Eliminar"
                                    onclick="confirmDelete('{{ $product->id }}')">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @endcan
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
@endsection
@section('scripts')
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
            buttons: [
                @can('product.create')
                {
                    text: '<i class="fas fa-plus"></i> Nuevo Producto',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{ route('products.create') }}"
                    }
                }
                @endcan
            ]

        });
    });
</script>
<script>
    function confirmDelete(productId) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            document.getElementById('delete-product-form-' + productId).submit();
        }
    }
</script>
@endsection
