<div class="form-row">
<div class="form-group col-md-3">
        <label for="type">Tipo</label>
        <input type="text" name="type" id="type" class="form-control" value="z" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="closings_date">Fecha de cierre</label>
        <input type="date" name="closings_date" id="closings_date" value="{{ $closingsDate }}" class="form-control" required readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="closings_hour">Hora de cierre</label>
        <input type="text" name="closings_hour" id="closings_hour" value="{{ $closingsHour }}" class="form-control" required readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="total_sale_ticket">Cantidad vendida en Tickets</label>
        <input type="text" name="total_sale_ticket" id="total_sale_ticket" value="{{ $totalTicketSales }}" class="form-control" required readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="total_sale_invoice">Cantidad vendida en Facturas</label>
        <input type="text" name="total_sale_invoice" id="total_sale_invoice" value="{{ $totalInvoiceSales }}" class="form-control" required readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="total_sale_tax_credit">Cantidad vendida en Créditos Fiscales</label>
        <input type="text" name="total_sale_tax_credit" id="total_sale_tax_credit" value="{{ $totalTaxCreditSales }}" class="form-control" required readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="start_ticket">Primer ticket</label>
        <input type="text" name="start_ticket" id="start_ticket" value="{{ $firstTicket->document_number ?? '0' }}" class="form-control" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="end_ticket">Último ticket</label>
        <input type="text" name="end_ticket" id="end_ticket" value="{{ $lastTicket->document_number ?? '0' }}" class="form-control" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="start_invoice">Primera factura</label>
        <input type="text" name="start_invoice" id="start_invoice" value="{{ $firstInvoice->document_number ?? '0' }}" class="form-control" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="end_invoice">Última factura</label>
        <input type="text" name="end_invoice" id="end_invoice" value="{{ $lastInvoice->document_number ?? '0' }}" class="form-control" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="start_tax_credit">Primer crédito fiscal</label>
        <input type="text" name="start_tax_credit" id="start_tax_credit" value="{{ $firstTaxCredit->document_number ?? '0' }}" class="form-control" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="end_tax_credit">Último crédito fiscal</label>
        <input type="text" name="end_tax_credit" id="end_tax_credit" value="{{ $lastTaxCredit->document_number ?? '0' }}" class="form-control" readonly>
    </div>
</div>
