<?php

namespace App\Http\Controllers;

use App\CashClosingz;
use App\Sale;
use App\User;
use App\CashOpening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CashClosingz\StoreRequest;
use App\Http\Requests\CashClosingz\UpdateRequest;

class CashClosingzController extends Controller
{
    public function index()
    {
        $cashClosingzs = CashClosingz::all();
        return view('admin.cashclosingz.index', compact('cashClosingzs'));
    }

public function create()
{
    // Obtener la fecha actual en formato Y-m-d
    $currentDate = Carbon::now('America/El_Salvador');
    $closingsDate = $currentDate->format('Y-m-d');

    // Obtener la hora actual en formato h:i A (con AM/PM)
    $closingsHour = $currentDate->format('h:i A');

    // Obtener la suma de cantidades de las ventas filtradas por document_type "Ticket" del día actual
    $totalTicketSales = Sale::where('document_type', 'Ticket')
                            ->whereDate('created_at', $closingsDate)
                            ->sum('total');

    // Obtener la suma de cantidades de las ventas filtradas por document_type "Factura" del día actual
    $totalInvoiceSales = Sale::where('document_type', 'Factura')
                             ->whereDate('created_at', $closingsDate)
                             ->sum('total');

    // Obtener la suma de cantidades de las ventas filtradas por document_type "Credito_fiscal" del día actual
    $totalTaxCreditSales = Sale::where('document_type', 'Credito_fiscal')
                               ->whereDate('created_at', $closingsDate)
                               ->sum('total');

    // Obtener la primera factura del día o asignar 0 si no existe
    $firstInvoice = Sale::where('document_type', 'Factura')
    ->whereDate('sale_date', $closingsDate)
    ->orderBy('document_number', 'asc')
    ->first() ?? 0;

    // Obtener el primer ticket del día o asignar 0 si no existe
    $firstTicket = Sale::where('document_type', 'Ticket')
        ->whereDate('sale_date', $closingsDate)
        ->orderBy('document_number', 'asc')
        ->first() ?? 0;

    // Obtener el primer crédito fiscal del día o asignar 0 si no existe
    $firstTaxCredit = Sale::where('document_type', 'credito_fiscal')
        ->whereDate('sale_date', $closingsDate)
        ->orderBy('document_number', 'asc')
        ->first() ?? 0;

    // Obtener la última factura del día o asignar 0 si no existe
    $lastInvoice = Sale::where('document_type', 'Factura')
        ->whereDate('sale_date', $closingsDate)
        ->orderBy('document_number', 'desc')
        ->first() ?? 0;

    // Obtener el último ticket del día o asignar 0 si no existe
    $lastTicket = Sale::where('document_type', 'Ticket')
        ->whereDate('sale_date', $closingsDate)
        ->orderBy('document_number', 'desc')
        ->first() ?? 0;

    // Obtener el último crédito fiscal del día o asignar 0 si no existe
    $lastTaxCredit = Sale::where('document_type', 'credito_fiscal')
        ->whereDate('sale_date', $closingsDate)
        ->orderBy('document_number', 'desc')
        ->first() ?? 0;

    return view('admin.cashclosingz.create', compact(
        'closingsDate',
        'closingsHour',
        'totalTicketSales',
        'totalInvoiceSales',
        'totalTaxCreditSales',
        'firstInvoice',
        'firstTicket',
        'firstTaxCredit',
        'lastInvoice',
        'lastTicket',
        'lastTaxCredit'
    ));
}


    public function store(StoreRequest $request)
    {
        $currentDate = Carbon::now('America/El_Salvador')->format('Y-m-d');
    
        // Crear el registro de cierre de caja
        $cashClosing = CashClosingz::create($request->all()+ [
            'user_id'=>Auth::user()->id,
            'closings_date' => Carbon::now('America/El_Salvador'),
        ]);
        return redirect()->route('cashclosingz.index');
    }

    public function show(CashClosingz $cashclosingz)
{
    // Cálculo de los totales
    if ($cashclosingz->end_ticket == 0 && $cashclosingz->start_ticket == 0)
    {$totalTickets = 0;}
    else
    {$totalTickets = $cashclosingz->end_ticket - $cashclosingz->start_ticket + 1;}

    if ($cashclosingz->end_invoice == 0 && $cashclosingz->start_invoice == 0)
    {$totalFacturas = 0;}
    else
    {$totalFacturas = $cashclosingz->end_invoice - $cashclosingz->start_invoice + 1;}
    
    if ($cashclosingz->end_tax_credit == 0 && $cashclosingz->start_tax_credit == 0)
    {$totalFiscales = 0;}
    else
    {$totalFiscales = $cashclosingz->end_tax_credit - $cashclosingz->start_tax_credit + 1;}

    return view('admin.cashclosingz.show', compact('cashclosingz', 'totalTickets', 'totalFacturas', 'totalFiscales'));
}

    
    

}
