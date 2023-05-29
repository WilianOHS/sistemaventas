@extends('layouts.admin')
@section('title', 'Apertura de caja')
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
                <div class="card mt-4"> 
                    <div class="card-header">Apertura de caja</div>

                    <div class="card-body">
                        {!! Form::open(['route'=>'cashopening.store','method'=>'POST']) !!}
                            @csrf

                            <div class="form-group row">
                                <label for="opening_balance" class="col-md-4 col-form-label text-md-right">Monto de apertura:</label>
                                <div class="col-md-6">
                                    <input id="opening_balance" type="number" step="0.01" class="form-control @error('opening_balance') is-invalid @enderror" name="opening_balance" value="{{ $cashOpening->opening_balance ?? old('opening_balance') }}" autofocus>
                                    @error('opening_balance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="income" class="col-md-4 col-form-label text-md-right">Ingresos:</label>

                                <div class="col-md-6">
                                    <input id="income" type="number" step="0.01" class="form-control @error('income') is-invalid @enderror" name="income" value="{{ old('income') }}">

                                    @error('income')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="voucher" class="col-md-4 col-form-label text-md-right">Vales:</label>

                                <div class="col-md-6">
                                    <input id="voucher" type="number" step="0.01" class="form-control @error('voucher') is-invalid @enderror" name="voucher" value="{{ old('voucher') }}">

                                    @error('voucher')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">Fecha:</label>

                                <div class="col-md-6">
                                    <input id="date" type="text" class="form-control" name="date" value="{{ Carbon\Carbon::parse($currentDate)->format('d-m-Y') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Guardar</button>

                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Resumen de apertura de caja</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Fecha:</th>
                                <td>{{ Carbon\Carbon::parse($cashOpening->date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Monto de apertura:</th>
                                <td>$ {{ $cashOpening->opening_balance }}</td>
                            </tr>
                            <tr>
                                <th>(+) Ingresos:</th>
                                <td>$ {{ $cashOpening->income }}</td>
                            </tr>
                            <tr>
                                <th>(+) Ventas totales:</th>
                                <td>$ {{ number_format($totalSales, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Subtotal:</th>
                                <td>$ {{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th>(-) Vales:</th>
                                <td>$ {{ $cashOpening->voucher }}</td>
                            </tr>
                            <tr>
                                <th>Total caja:</th>
                                <td>$ {{ number_format($totalCash, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmChangeModal" tabindex="-1" role="dialog" aria-labelledby="confirmChangeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmChangeModalLabel">Confirmar Cambio de Monto de Apertura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas cambiar el monto de apertura?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmChangeBtn" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('opening_balance').addEventListener('change', function() {
        var openingBalance = parseFloat(this.value);
        var currentOpeningBalance = parseFloat("{{ $cashOpening->opening_balance ?? 0 }}");
        if (openingBalance !== currentOpeningBalance) {
            $('#confirmChangeModal').modal('show');
        }
    });

    document.getElementById('confirmChangeBtn').addEventListener('click', function() {
        document.getElementById('saveBtn').click();
    });
</script>
@endsection
