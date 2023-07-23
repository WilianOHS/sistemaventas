@extends('layouts.admin')
 @section('title','Gestion de roles del sistema')
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
            Roles del sistema
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles del sistema</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="roles_listing" class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$role->id}}</th>
                            <td>
                              @can('roles.show')
                              <a href="{{route('roles.show',$role)}}">{{$role->name}}</a> 
                                @else
                                    <span>{{$role->name}}</span>
                                @endcan                    
                            </td>    
                            <td>{{$role->description}}</td>      
                            <td style="width:20%">
                            {!! Form::open(['route'=>['roles.destroy', $role], 'method'=>'DELETE', 'id' => 'delete-role-form-' . $role->id]) !!}
                              @can('roles.edit')
                              <a class="btn btn-outline-info" href="{{ route('roles.edit', $role) }}" title="editar">
                                  <i class="far fa-edit"></i>
                              </a>
                              @endcan

                              @can('roles.destroy')
                              <button class="btn btn-outline-danger" type="button" title="Eliminar" onclick="confirmDelete('{{ $role->id }}')">
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
{!! Html::script('melody/js/data-table.js') !!}
<script>
    function confirmDelete(roleId) {
        var deleteFormId = 'delete-role-form-' + roleId;
        if (confirm('¿Estás seguro de que deseas eliminar este rol? Esta acción no se puede deshacer.')) {
            document.getElementById(deleteFormId).submit();
        }
    }
</script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#roles_listing').DataTable({
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
              @can('roles.create')
                {
                    text: '<i class="fas fa-plus"></i> Agregar Roles',
                    className: 'btn btn-info',
                    action: function ( e, dt, node, conf ) {
                        window.location.href = "{{route('roles.create')}}"
                    }
                }
                @endcan
            ]
        });
    });
</script>
@endsection
