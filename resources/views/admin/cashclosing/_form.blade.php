<div class="form-row">
    <div class="form-group col-md-4">
        <label for="type">Tipo</label>
        <select name="type" id="type" class="form-control" required>
            <option value="" disabled selected>Seleccione un tipo</option>
            <option value="c">c</option>
            <option value="z">z</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="closings_date">Fecha de cierre</label>
        <input type="date" name="closings_date" id="closings_date" value="{{ $closingsDate }}" class="form-control" required readonly>
    </div>
    <div class="form-group col-md-4">
        <label for="closings_hour">Hora de cierre</label>
        <input type="text" name="closings_hour" id="closings_hour" value="{{ $closingsHour }}" class="form-control" required readonly>
    </div>
</div>

<div class="form-group">
    <label for="cash_sales">Suma de ventas en efectivo</label>
    <input type="text" name="cash_sales" id="cash_sales" value="{{ $sumCashSales }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="card_sales">Suma de ventas con tarjeta</label>
    <input type="text" name="card_sales" id="card_sales" value="{{ $sumCardSales }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="initial_balance">Saldo Inicial</label>
    <input type="text" name="initial_balance" id="initial_balance" value="{{ $cashOpening->opening_balance  }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="income">Ingresos</label>
    <input type="text" name="income" id="income" value="{{ $income }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="daily_sales">Ventas del dia</label>
    <input type="text" name="daily_sales" id="daily_sales" value="{{ $totalSales }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="vouchers">Vales</label>
    <input type="text" name="vouchers" id="vouchers" value="{{ $voucher }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="cash">Efectivo en caja</label>
    <input type="number" name="cash" id="cash" class="form-control" placeholder="Efectivo" step="any" required>
</div>


<!-- Campos no editables -->

<div class="form-group">
    <label for="start_ticket">Primer ticket</label>
    <input type="text" name="start_ticket" id="start_ticket" value="{{ $firstTicket->document_number ?? '0' }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="end_ticket">Último ticket</label>
    <input type="text" name="end_ticket" id="end_ticket" value="{{ $lastTicket->document_number ?? '0' }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="start_invoice">Primera factura</label>
    <input type="text" name="start_invoice" id="start_invoice" value="{{ $firstInvoice->document_number ?? '0' }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="end_invoice">Última factura</label>
    <input type="text" name="end_invoice" id="end_invoice" value="{{ $lastInvoice->document_number ?? '0' }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="start_tax_credit">Primer crédito fiscal</label>
    <input type="text" name="start_tax_credit" id="start_tax_credit" value="{{ $firstTaxCredit->document_number ?? '0' }}" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="end_tax_credit">Último crédito fiscal</label>
    <input type="text" name="end_tax_credit" id="end_tax_credit" value="{{ $lastTaxCredit->document_number ?? '0' }}" class="form-control" readonly>
</div>


