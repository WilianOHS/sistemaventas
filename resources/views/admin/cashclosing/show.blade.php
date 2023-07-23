@extends('layouts.admin')
@section('title', 'Detalles de cierre de caja')
@section('styles')

@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Detalles de cierre de caja
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cashclosing.index') }}">Cierres de caja</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de cierre de caja</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                    <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Corte Tipo</strong></label>
                            <p style="font-size: 18px">{{ $cashclosing->type }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Corte de caja</strong></label>
                            <p style="font-size: 18px">{{ $cashclosing->id }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Empleado</strong></label>
                            <p style="font-size: 18px">
                                {{ $cashclosing->user->name ?? 'Usuario Eliminado' }}
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Fecha</strong></label>
                            <p style="font-size: 18px">{{ \Carbon\Carbon::parse($cashclosing->closings_date)->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                        <label class="form-control-label" style="font-size: 18px"><strong>Hora</strong></label>
                            <p style="font-size: 18px">{{ $cashclosing->closings_hour }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive col-md-12">
                          <table>
                            <tbody>
                            <tr>
                                <th></th>
                                <td style="padding-right: 10px;">Desde</td>
                                <td style="padding-left: 10px;">Hasta</td>
                              </tr>
                              <tr>
                                <th>Tickets</th>
                                <td style="padding-right: 10px;">{{ $cashclosing->start_ticket }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosing->end_ticket }}</td>
                              </tr>
                              <tr>
                                <th>Facturas</th>
                                <td style="padding-right: 10px;">{{ $cashclosing->start_invoice }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosing->end_invoice }}</td>
                              </tr>
                              <tr>
                                <th>Fiscales</th>
                                <td style="padding-right: 10px;">{{ $cashclosing->start_tax_credit }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosing->end_tax_credit }}</td>
                              </tr>
                              <tr>
                                <td colspan="2"><br></td>
                              </tr>

                              <tr>
                                <th>Saldo Inicial $:</th>
                                <td>{{ $cashclosing->initial_balance }}</td>
                              </tr>
                              <tr>
                                <th>(+) Venta $:</th>
                                <td>{{$totalSales }}</td>
                              </tr>
                              <tr>
                                <th>(+) Ingresos $:</th>
                                <td>{{$cashclosing->income }}</td>
                              </tr>
                              <th>Subtotal $:</th>
                              <td>{{ number_format($subtotal, 2) }}</td>
                              </tr>
                              <tr>
                              <tr>
                              <th>(-) Vales $:</th>
                              <td>{{ $cashclosing->vouchers }}</td>
                              </tr>
                              <tr>
                              <th>Total Caja $:</th>
                              <td>{{ number_format($cashTotal, 2) }}</td>
                              </tr>
                              <tr>
                              <td colspan="2"><br></td>
                              </tr>
                              <tr>
                                <th>Detalle de pagos</th>
                              </tr> 
                              <tr>
                              <th>Efectivo $:</th>
                              <td>{{ $totalCashSales }}</td>
                              </tr>
                              <tr>
                              <th>Tarjeta $:</th>
                              <td>{{ $totalCardSales }}</td>
                              </tr>
                              <tr>
                              <th>Venta $:</th>
                              <td>{{ $sale }}</td>
                              </tr>
                              <tr>
                              <td colspan="2"><br></td>
                            </tr>
                              <tr>
                                <th>Efectivo $:</th>
                                <td>{{ $cashclosing->cash }}</td>
                              </tr>
                              <tr>
                                <th>Diferencia $:</th>
                                <td>{{ $difference }}</td>
                              </tr>
                            </tbody>
                          </table>

                        </div>
                    </div>   
                </div>
                <div class="card-footer text-muted">
                    <a href="{{ route('cashclosing.index') }}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
