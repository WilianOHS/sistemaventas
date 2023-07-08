@extends('layouts.admin')
@section('title', 'Cierre de Caja')
@section('styles')
<style type="text/css">
    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
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
            Cierre de Caja
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cierre de Caja</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="cash_closing_listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Usuario</th>
                                    <th>Fecha de Cierre</th>
                                    <th>Hora de Cierre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashClosingzs as $cashClosingz)
                                <tr>
                                    <th scope="row">{{ $cashClosingz->id }}</th>
                                    <td>{{ $cashClosingz->type }}</td>
                                    <td>{{ $cashClosingz->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cashClosingz->closings_date)->format('d-m-Y') }}</td>
                                    <td>{{ $cashClosingz->closings_hour }}</td>
                                    <td style="width: 20%;">

                                    <a href="{{route('cashclosingz.show', $cashClosingz)}}" class="btn btn-outline-info"
                                         title="Ver detalles"><i class="far fa-eye"></i></a>

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
        var table = $('#cash_closing_listing').DataTable({
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
                {
                    text: '<i class="fas fa-plus"></i> Nuevo Cierre de Caja Z',
                    className: 'btn btn-info',
                    action: function (e, dt, node, conf) {
                        window.location.href = "{{ route('cashclosingz.create') }}"
                    }
                }
            ]
        });
    });
</script>
@endsection
