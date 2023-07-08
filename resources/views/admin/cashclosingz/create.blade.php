@extends('layouts.admin')
@section('title', 'Registrar cierre de caja')
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
            Registro de cierre de caja
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cashclosingz.index') }}">Cierres de Caja</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de cierre de caja</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'cashclosingz.store', 'method' => 'POST']) !!}
                    @include('admin.cashclosingz._form')
                    <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                    <a href="{{ route('cashclosingz.index') }}" class="btn btn-light">Cancelar</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection
