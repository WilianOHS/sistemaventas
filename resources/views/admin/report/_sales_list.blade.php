<tr>
    <th scope="row">
        <a href="{{route('sales.show', $sale)}}">{{$sale->id}}</a>
    </th>
    <td>
        {{\Carbon\Carbon::parse($sale->sale_date)->format('d M y h:i a')}}
    </td>
    <td>{{$sale->total}}</td>
    @if (auth()->user()->can('change.status.sales'))
    @if ($sale->status == 'VALID')
            <td>
                <a class="jsgrid-button btn btn-success" href="{{ route('change.status.sales', $sale) }}"
                title="editar">
                    Activo <i class="fas fa-check"></i>
                </a>
            </td>
        @else
            <td>
                <a class="jsgrid-button btn btn-danger" href="{{ route('change.status.sales', $sale) }}"
                title="editar">
                    Desactivado <i class="fas fa-times"></i>
                </a>
            </td>
        @endif
    @else
        <td>
            @if ($sale->status == 'VALID')
                Activo
            @else
                Desactivado
            @endif
        </td>
    @endif
    <td style="width: 20%;">
                            @can('sales.pdf')
                            <a href="{{route('sales.pdf', $sale)}}" class="btn btn-outline-danger"
                            title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                            @endcan
                            @can('sales.print')
                            <!-- <a href="{{route('sales.print', $sale)}}" class="btn btn-outline-warning"
                            title="Imprimir boleta"><i class="fas fa-print"></i></a> -->
                            @endcan
                            @can('sales.show')
                            <a href="{{route('sales.show', $sale)}}" class="btn btn-outline-info"
                            title="Ver detalles"><i class="far fa-eye"></i></a>
                            @endcan
                            @can('sales.print')
                            @if($sale->document_type == 'Ticket')
                                <a href="{{route('sales.ticket', $sale)}}" class="btn btn-outline-danger" title="Imprimir Ticket">
                                    <i class="fas fa-print"></i>
                                </a>
                            @endif
                            @if($sale->document_type == 'Factura')
                                <a href="{{route('sales.envoice', $sale)}}" class="btn btn-outline-danger" title="Imprimir Factura">
                                    <i class="fas fa-print"></i>
                                </a>
                            @endif
                            @if($sale->document_type == 'credito_fiscal')
                                <a href="{{route('sales.tax_credit', $sale)}}" class="btn btn-outline-danger" title="Imprimir Crédito Fiscal">
                                    <i class="fas fa-print"></i>
                                </a>
                            @endif
                            @endcan  
    </td>
</tr>