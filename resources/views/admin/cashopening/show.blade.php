@extends('layouts.admin')
@section('title', 'Detalles de apertura de caja')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalles de apertura de caja</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Fecha:</label>
                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control" name="date" value="{{ $cashOpening->date }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opening_balance" class="col-md-4 col-form-label text-md-right">Monto de apertura:</label>
                            <div class="col-md-6">
                                <input id="opening_balance" type="text" class="form-control" name="opening_balance" value="{{ $cashOpening->opening_balance }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_sales" class="col-md-4 col-form-label text-md-right">Ventas totales:</label>
                            <div class="col-md-6">
                                <input id="total_sales" type="text" class="form-control" name="total_sales" value="{{ $totalSales }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('cashopening.index') }}" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
