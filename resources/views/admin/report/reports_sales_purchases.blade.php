@extends('layouts.admin')
@section('title', 'Gestión de ventas y compras')
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
            Ventas y Compras
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ventas y Compras</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sales_purchases_listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($combinedData as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item instanceof \App\Sale ? 'Venta' : 'Compra' }}</td>
                                    <td>{{ $item->sale_date ?? $item->purchase_date }}</td>
                                    <td>$ {{ $item->total }}</td>
                                    <td>
                                        @if ($item instanceof \App\Sale)
                                            @can('change.status.sales')
                                                @if ($item->status == 'VALID')
                                                    <a class="jsgrid-button btn btn-success" href="{{route('change.status.sales', $item)}}" title="editar">
                                                        Activo<i class="fas fa-check"></i>
                                                    </a>
                                                @else
                                                    <a class="jsgrid-button btn btn-danger" href="{{route('change.status.sales', $item)}}" title="editar">
                                                        Desactivado <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                        @elseif ($item instanceof \App\Purchase)
                                            @can('change.status.purchases')
                                                @if ($item->status == 'VALID')
                                                    <a class="jsgrid-button btn btn-success" href="{{route('change.status.purchases', $item)}}" title="editar">
                                                        Activo<i class="fas fa-check"></i>
                                                    </a>
                                                @else
                                                    <a class="jsgrid-button btn btn-danger" href="{{route('change.status.purchases', $item)}}" title="editar">
                                                        Desactivado <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item instanceof \App\Sale)
                                            @can('sales.pdf')
                                                <a href="{{route('sales.pdf', $item)}}" class="btn btn-outline-danger" title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                                            @endcan
                                            @can('sales.print')
                                                @if($item->document_type == 'Ticket')
                                                    <a href="{{route('sales.ticket', $item)}}" class="btn btn-outline-danger" title="Imprimir Ticket"><i class="fas fa-print"></i></a>
                                                @endif
                                                @if($item->document_type == 'Factura')
                                                    <a href="{{ route('sales.envoice', $item) }}" class="btn btn-outline-danger" title="Imprimir Factura" target="_blank"><i class="fas fa-print"></i></a>
                                                @endif
                                                @if($item->document_type == 'credito_fiscal')
                                                    <a href="{{route('sales.tax_credit', $item)}}" class="btn btn-outline-danger" title="Imprimir Crédito Fiscal" target="_blank"><i class="fas fa-print"></i></a>
                                                @endif
                                            @endcan
                                            @can('sales.show')
                                                <a href="{{route('sales.show', $item)}}" class="btn btn-outline-info" title="Ver detalles"><i class="far fa-eye"></i></a>
                                            @endcan
                                        @elseif ($item instanceof \App\Purchase)
                                            @can('purchases.pdf')
                                                <a href="{{route('purchases.pdf', $item)}}" class="btn btn-outline-danger" title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                                            @endcan
                                            @can('purchases.show')
                                                <a href="{{route('purchases.show', $item)}}" class="btn btn-outline-info" title="Ver detalles"><i class="far fa-eye"></i></a>
                                            @endcan
                                        @endif
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
        var salesPurchasesTable = $('#sales_purchases_listing').DataTable({
            responsive: true,
            order: [[0, "desc"]],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            dom:
                "<'row'<'col-sm-2'l><'col-sm-7 text-right'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    text: '<i class="fas fa-file-excel"></i> Exportar Ventas y Compras',
                    className: 'btn btn-success',
                    action: function(e, dt, node, conf) {
                        // Redirige a la ruta de exportación
                        window.location.href = "{{ route('export_sales_and_purchases') }}";
                    }
                },
            ]
        });
    });
</script>
@endsection
