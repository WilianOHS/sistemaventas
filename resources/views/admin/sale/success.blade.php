@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success" role="alert">
        El cliente {{ $client->name }} ha sido registrado exitosamente.
    </div>
</div>
@endsection
