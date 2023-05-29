<?php

namespace App\Http\Controllers;

use App\CashClosing;
use App\Sale;
use App\User;
use App\CashOpening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CashClosing\StoreRequest;
use App\Http\Requests\CashClosing\UpdateRequest;

class CashClosingController extends Controller
{
    public function index()
    {
        // Obtener todas las ventas
        $sales = Sale::get();

        // Obtener todos los usuarios
        $users = User::get();

        // Obtener todos los registros de apertura de caja
        $cashOpenings = CashOpening::get();

        // Obtener todos los cierres de caja
        $cashClosings = CashClosing::get();

        return view('admin.cashclosing.index', compact('sales', 'users', 'cashOpenings', 'cashClosings'));
    }

    public function create()
    {
        // Obtener la fecha actual en formato Y-m-d
        $currentDate = Carbon::now('America/El_Salvador');
        $closingsDate = $currentDate->format('Y-m-d');
    
        $totalSales = Sale::whereDate('sale_date', $closingsDate)
        ->where('status', 'valid')
        ->sum('total');
    
        // Obtener el registro de apertura de caja más reciente
        $cashOpening = CashOpening::latest()->first();
    
        // Verificar si existe un registro de apertura de caja
        if ($cashOpening) {
            $voucher = $cashOpening->voucher;
            $income = $cashOpening->income;
        } else {
            $voucher = 0;
            $income = 0;
        }
    
        // Obtener la hora actual en formato h:i A (con AM/PM)
        $closingsHour = $currentDate->format('h:i A');
    
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
        $firstTaxCredit = Sale::where('document_type', 'Crédito Fiscal')
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
        $lastTaxCredit = Sale::where('document_type', 'Crédito Fiscal')
            ->whereDate('sale_date', $closingsDate)
            ->orderBy('document_number', 'desc')
            ->first() ?? 0;
    
        // Obtener la fecha actual en la zona horaria de El Salvador
        $currentDate = Carbon::now('America/El_Salvador')->format('Y-m-d');
    
        // Obtener la suma de ventas en efectivo del día actual
        $sumCashSales = Sale::where('payment_method', 'Efectivo')
            ->whereDate('sale_date', $currentDate)
            ->sum('total');
    
        // Obtener la suma de ventas en tarjeta del día actual
        $sumCardSales = Sale::where('payment_method', 'Tarjeta')
            ->whereDate('sale_date', $currentDate)
            ->sum('total');
    
        // Obtener todas las ventas
        $sales = Sale::get();
    
        // Obtener todos los usuarios
        $users = User::get();
    
        return view('admin.cashclosing.create', compact(
            'sales',
            'users',
            'cashOpening',
            'closingsDate',
            'closingsHour',
            'firstInvoice',
            'firstTicket',
            'firstTaxCredit',
            'lastInvoice',
            'lastTicket',
            'lastTaxCredit',
            'sumCashSales',
            'sumCardSales',
            'totalSales',
            'voucher',
            'income',
        ));
    }
    
    

    public function store(StoreRequest $request)
    {
        $currentDate = Carbon::now('America/El_Salvador')->format('Y-m-d');
        $cashOpening = CashOpening::where('date', $currentDate)
            ->first();
    
        // Crear el registro de cierre de caja
        $cashClosing = CashClosing::create($request->all()+ [
            'user_id'=>Auth::user()->id,
            'cashopening_id' => $cashOpening->id, // Agregar el ID de CashOpening
            'closings_date' => Carbon::now('America/El_Salvador'),
        ]);
    
    
        return redirect()->route('cashclosing.index');
    }
    
    public function show(CashClosing $cashclosing)
    {
        $currentDate = Carbon::now('America/El_Salvador')->format('Y-m-d');
        $totalSales = $cashclosing->daily_sales;
        $cashOpening = $cashclosing->initial_balance;
    
        $subtotal = $cashclosing->initial_balance + $totalSales + $cashclosing->income;
        $cashTotal = $subtotal - $cashclosing->vouchers;
    
        $totalCashSales = $cashclosing->cash_sales;
    
        $totalCardSales = $cashclosing->card_sales;
    
        $sale = $totalCashSales + $totalCardSales;
    
        $difference = $cashclosing->cash - $cashTotal;
    
        return view('admin.cashclosing.show', compact('cashclosing', 'cashOpening', 'totalSales', 'subtotal', 'cashTotal', 'totalCashSales', 'totalCardSales', 'sale', 'difference'));
    }
    
    
    
    
}
