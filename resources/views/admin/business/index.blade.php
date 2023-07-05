@extends('layouts.admin')
 @section('title','Datos de empresa')
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
          Datos de empresa
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Datos de empresa</li>
            </ol>
        </nav>
    </div>
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Datos de empresa</h4>
                          <!-- <div class="btn-group">
                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{route('clients.create')}}" class="dropdown-item">Agregar</a>
                          </div>
                        </div> -->
                    </div>


        <div class="form-row">
          <div class="form-group col-md-6">
                        <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>
                        <p class="text-muted">
                            {{$business->name}}
                        </p>
                        <hr>
                        <strong><i class="fas fa-align-left mr-1"></i> Descripción</strong>
                        <p class="text-muted">
                            {{$business->description}}
                        </p>
                        <hr>
                        <strong><i class="fas fa-map-marked-alt mr-1"></i>Dirección</strong>
                        <p class="text-muted">
                            {{$business->address}}
                        </p>
                        <hr>
                        <strong><i class="fas fa-address-card mr-1"></i>NIT</strong>
                        <p class="text-muted">{{$business->nit}}</p>
                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i>Correo electrónico</strong>
                        <p class="text-muted">{{$business->mail}}</p>
                        <hr>
                        </div>
                        <div class="form-group col-md-6">    
                        <strong><i class="fas fa-mobile-alt mr-1"></i>Número de contacto</strong>
                        <p class="text-muted">{{$business->number}}</p>
                        <hr>
                        <strong><i class="fas fa-industry mr-1"></i>Giro de la empresa</strong>
                        <p class="text-muted">{{$business->business_sector}}</p>
                        <hr>
                        <strong><i class="fas fa-comment-alt mr-1"></i>Mensaje de despedida</strong>
                        <p class="text-muted">{{$business->message}}</p>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <strong><i class="fas fa-exclamation-circle mr-1">Logo</i></strong><br>
                          </div>
                          <div class="col-md-6">
                            <img style="width:50px ; height:50px ;" src="{{asset('image/'.$business->logo)}}" class="rounded float-left" alt="logo">
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                    
                      <div class="card-footer text-muted">
                      @can('business.edit')
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal-2">Actualizar datos</button>
                      @endcan
                      </div>
                </div>
            </div>
        </div>
</div>

                  <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Actualización de datos de la empresa</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        {!! Form::model($business,['route'=>['business.update',$business],'method'=>'PUT','files'=> true]) !!}
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$business->name}}" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{{$business->description}}</textarea>
                          </div>

                          <div class="form-group">
                            <label for="mail">Correo electrónico</label>
                            <input type="email" name="mail" id="mail" class="form-control" value="{{$business->mail}}" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{$business->address}}" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                            <label for="nit">Número de NIT</label>
                            <input type="text" name="nit" id="nit" class="form-control" value="{{$business->nit}}" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                            <label for="number">Número de Teléfono</label>
                            <input type="text" name="number" id="number" class="form-control" value="{{$business->number}}" aria-describedby="helpId">
                          </div>


                          <div class="form-group">
                            <label for="business_sector">Giro</label>
                            <input type="text" name="business_sector" id="business_sector" class="form-control" value="{{$business->business_sector}}" aria-describedby="helpId">
                          </div>

                          <div class="form-group">
                            <label for="message">Mensaje</label>
                            <input type="text" name="message" id="message" class="form-control" value="{{$business->message}}" aria-describedby="helpId">
                          </div>

                      <div class="card-body d-flex flex-column align-items-center">
                      <h5 class="card-title d-flex">Logotipo de la empresa

                      </h5>
                      
                      <input type="file" name="logotipo" id="logotipo" class="dropify" />
                      <div class="d-flex flex-column align-items-center my-auto">
                        @if ($business->logo)
                          <img src="{{ asset('image/' . $business->logo) }}" alt="Logotipo de la empresa" style="width: 100px; height: 100px;" class="mx-auto">
                        @endif
                      </div>
                    </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Actualizar</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('melody/js/dropify.js') !!}
@endsection
