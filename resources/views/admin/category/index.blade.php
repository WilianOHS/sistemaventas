@extends('layouts.admin')
 @section('title','Gestion de categorias')
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
            Categorías
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorías</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  

                  <div class="table-responsive">
                    <table id="category_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>
                                                              
                                <a href="#">{{$category->name}}</a>
                            </td>    
                            <td>{{$category->description}}</td>      
                            <td style="width: 20%;">
                                {!! Form::open(['route'=>['categories.destroy',
                                $category], 'method'=>'DELETE']) !!}

                                <a href="{{route('categories.edit',$category)}}" class="btn btn-outline-info"
                                 title="Editar"><i class="far fa-edit"></i></a>

                                 <button class="btn btn-outline-danger" 
                                type="submit" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                   
                            </td>

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
        var table = $('#category_listing').DataTable({
            responsive: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            dom:
			"<'row'<'col-sm-2'l><'col-sm-7 text-right'B><'col-sm-3'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>", 
            buttons: [
                {
                    text: '<i class="fas fa-plus"></i> Nueva Categoría',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('categories.create')}}"
                    }
                }
            ]
        });
    });
</script>
@endsection
