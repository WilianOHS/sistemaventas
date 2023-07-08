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
                <li class="breadcrumb-item"><a href="{{ route('cashclosingz.index') }}">Cierres de caja</a></li>
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
                            <p style="font-size: 18px">{{ $cashclosingz->type }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Corte de caja</strong></label>
                            <p style="font-size: 18px">{{ $cashclosingz->id }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Empleado</strong></label>
                            <p style="font-size: 18px">{{ $cashclosingz->user->name }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label" style="font-size: 18px"><strong>Fecha</strong></label>
                            <p style="font-size: 18px">{{ \Carbon\Carbon::parse($cashclosingz->closings_date)->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                        <label class="form-control-label" style="font-size: 18px"><strong>Hora</strong></label>
                            <p style="font-size: 18px">{{ $cashclosingz->closings_hour }}</p>
                        </div>
                    </div>

                    <div>
                        <table>
                            <tbody>
                                <tr>                                                    
                                <th></th>                   
                                <td style="padding-right: 10px;">Total</td>
                                </tr>
                                <tr>
                                <th>Tickets</th>
                                <td style="padding-right: 10px;"> {{ $cashclosingz->total_sale_ticket }}</td>
                                </tr>
                                <tr>
                                <th>Facturas</th>
                                <td style="padding-right: 10px;"> {{ $cashclosingz->total_sale_invoice }}</td>
                                </td>
                            </tr>
                            <tr>
                                <th>Fiscales</th>
                                <td style="padding-right: 10px;"> {{ $cashclosingz->total_sale_tax_credit }}</td>
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td style="padding-right: 10px;">
                                    {{ $cashclosingz->total_sale_ticket + $cashclosingz->total_sale_invoice + $cashclosingz->total_sale_tax_credit }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><br></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive col-md-12">
                          <table>
                            <tbody>
                            <tr>
                                <th></th>
                                <td style="padding-right: 10px;">Inicio</td>
                                <td style="padding-left: 10px;">Final</td>
                                <td style="padding-left: 10px;">Total</td>
                              </tr>
                              <tr>
                                <th>Tickets</th>
                                <td style="padding-right: 10px;">{{ $cashclosingz->start_ticket }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosingz->end_ticket }}</td>
                                <td style="padding-left: 10px;">
                                    @if ($cashclosingz->end_ticket == 0 && $cashclosingz->start_ticket == 0)
                                        0
                                    @else
                                        {{ $cashclosingz->end_ticket - $cashclosingz->start_ticket + 1 }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Facturas</th>
                                <td style="padding-right: 10px;">{{ $cashclosingz->start_invoice }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosingz->end_invoice }}</td>
                                <td style="padding-left: 10px;">
                                    @if ($cashclosingz->end_invoice == 0 && $cashclosingz->start_invoice == 0)
                                        0
                                    @else
                                        {{ $cashclosingz->end_invoice - $cashclosingz->start_invoice + 1 }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Fiscales</th>
                                <td style="padding-right: 10px;">{{ $cashclosingz->start_tax_credit }}</td>
                                <td style="padding-left: 10px;">{{ $cashclosingz->end_tax_credit }}</td>
                                <td style="padding-left: 10px;">
                                    @if ($cashclosingz->end_tax_credit == 0 && $cashclosingz->start_tax_credit == 0)
                                        0
                                    @else
                                    {{ $cashclosingz->end_tax_credit - $cashclosingz->start_tax_credit + 1 }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
    <th>Total</th>
    <td style="padding-right: 10px;"></td>
    <td style="padding-left: 10px;"></td>
    <td style="padding-left: 10px;">
        {{ $totalTickets + $totalFacturas + $totalFiscales }}
    </td>
</tr>


                              <tr>
                                <td colspan="2"><br></td>
                              </tr>

                            </tbody>
                          </table>

                        </div>
                    </div>   
                </div>
                <div class="card-footer text-muted">
                    <a href="{{ route('cashclosingz.index') }}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
