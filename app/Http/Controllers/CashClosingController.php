<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CashClosing;

class CashClosingController extends Controller
{
    // Método para mostrar el formulario de cierre de caja
    public function create()
    {
        return view('cash_closing.form');
    }

    // Método para procesar el formulario de cierre de caja
    public function store(Request $request)
    {
        // Validar datos del formulario
        $validatedData = $request->validate([
            'initial_balance' => 'required|numeric',
            'income' => 'required|numeric',
            'vouchers' => 'required|integer',
            'cash_payments' => 'required|numeric',
            'card_payments' => 'required|numeric',
            'cash' => 'required|numeric',
            'difference' => 'required|numeric',
        ]);

        // Crear registro de cierre de caja
        $cashClosing = new \App\Models\CashClosing();
        $cashClosing->initial_balance = $request->input('initial_balance');
        $cashClosing->income = $request->input('income');
        $cashClosing->vouchers = $request->input('vouchers');
        $cashClosing->cash_payments = $request->input('cash_payments');
        $cashClosing->card_payments = $request->input('card_payments');
        $cashClosing->cash = $request->input('cash');
        $cashClosing->difference = $request->input('difference');
        $cashClosing->save();

        // Redirigir a la página de cierre de caja con un mensaje de éxito
        return redirect()->route('cash_closing.index')->with('success', 'El cierre de caja se ha registrado exitosamente.');
    }

    // Método para mostrar el historial de cierres de caja
    public function index()
    {
        // Obtener todos los registros de cierre de caja
        //$cashClosings = \App\Models\CashClosing::orderBy('created_at', 'desc')->paginate(10);
        $cashclosings = CashClosing::get();

        // Mostrar la vista con el historial de cierres de caja
        //return view('cash_closing.index', ['cashClosings' => $cashClosings]);
        
        return view('admin.cashclosing.index',compact('cashclosings'));
    }
}
