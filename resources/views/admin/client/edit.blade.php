@extends('layouts.admin')
 @section('title','Editar cliente')
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
            Edición de clientes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edición de clientes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edición de cliente</h4>    
                    </div>
                    {!! Form::model($client,['route'=>['clients.update',$client],'method'=>'PUT','files'=> true]) !!}
                    
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="{{$client->name}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="dui">DUI</label>
                        <input type="number" name="dui" id="dui" value="{{$client->dui}}" class="form-control" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" id="address" value="{{$client->address}}" class="form-control" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefóno / Celular</label>
                        <input type="number" name="phone" id="phone"  value="{{$client->phone}}" class="form-control" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email"  value="{{$client->email}}" class="form-control" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Editar</button>
                    <a href="{{route('clients.index')}}" class="btn btn-light">
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
