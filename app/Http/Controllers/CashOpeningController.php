<?php

namespace App\Http\Controllers;

use App\CashOpening;
use App\CashClosure;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashOpeningController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->toDateString();
    
        $cashOpening = CashOpening::where('date', $currentDate)->first();
    
        if (!$cashOpening) {
            $cashOpening = CashOpening::create([
                'date' => $currentDate,
            ]);
        }
    
        $totalSales = Sale::whereDate('sale_date', $cashOpening->date)->sum('total');
        
        $subtotal = $cashOpening->opening_balance + $totalSales + $cashOpening->income;
        $totalCash = $subtotal - $cashOpening->voucher;
    
        return view('admin.cashopening.index', compact('cashOpening', 'totalSales', 'currentDate', 'subtotal', 'totalCash'));
    }
    

    public function store(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();
    
        $cashOpening = CashOpening::where('date', $currentDate)->first();
    
        if (!$cashOpening) {
            $cashOpening = CashOpening::create([
                'date' => $currentDate,
                'opening_balance' => $request->input('opening_balance'),
                'income' => $request->input('income'),
                'voucher' => $request->input('voucher'),
            ]);
        } else {
            $cashOpening->opening_balance = $request->input('opening_balance');
            $cashOpening->income += $request->input('income');
            $cashOpening->voucher += $request->input('voucher');
            $cashOpening->save();
        }
    
        return redirect()->route('cashopening.index');
    }
    


    public function show(CashOpening $cashOpening)
    {
        $totalSales = Sale::whereDate('sale_date', $cashOpening->date)->sum('total');
        
        $subtotal = $cashOpening->opening_balance + $totalSales + $cashOpening->income;
        $totalCash = $subtotal - $cashOpening->voucher;

        return view('admin.cashopening.show', compact('cashOpening', 'totalSales', 'subtotal', 'totalCash'));
    }

    public function closeCashRegister(Request $request, CashOpening $cashOpening)
    {
        $currentDate = Carbon::now()->toDateString();
        $closingBalance = $request->input('closing_balance');

        $cashClosure = CashClosure::where('opening_id', $cashOpening->id)->first();

        if (!$cashClosure) {
            $cashClosure = CashClosure::create([
                'date' => $currentDate,
                'closing_balance' => $closingBalance,
                'opening_id' => $cashOpening->id,
            ]);
        }

        return redirect()->route('cash.closure.show', $cashClosure);
    }

    public function showCashClosure(CashClosure $cashClosure)
    {
        return view('admin.cash.closure.show', compact('cashClosure'));
    }
}
