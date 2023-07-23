<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:reports.day')->only(['reports_day']);
        $this->middleware('can:reports.date')->only(['reports_date']);
    }
    public function reports_day()
    {
        $sales = Sale::whereDate('sale_date', Carbon::today('America/El_Salvador'))
                    ->where('status', 'VALID')
                    ->get();

        $total = $sales->sum('total');

        return view('admin.report.reports_day', compact('sales', 'total'));
    }

    public function reports_date()
    {
        $sales = Sale::whereDate('sale_date', Carbon::today('America/El_Salvador'))
                    ->where('status', 'VALID')
                    ->get();

        $total = $sales->sum('total');

        return view('admin.report.reports_date', compact('sales', 'total'));
    }

    public function report_results(Request $request)
    {
        // Obtener fechas del formulario
        $fi = $request->fecha_ini . ' 00:00:00';
        $ff = $request->fecha_fin . ' 23:59:59';
    
        // Verificar si se enviaron las fechas del formulario
        if ($request->has('fecha_ini') && $request->has('fecha_fin')) {
            // Guardar las fechas en la sesión solo si se enviaron desde el formulario
            session(['fecha_ini' => $request->fecha_ini]);
            session(['fecha_fin' => $request->fecha_fin]);
        }
    
        // Obtener ventas con las fechas del formulario o las guardadas en la sesión
        $sales = Sale::whereBetween('sale_date', [$fi, $ff])
                     ->where('status', 'VALID')
                     ->get();
    
        $total = $sales->sum('total');
    
        return view('admin.report.reports_date', compact('sales', 'total'));
    }
    

    
    
}
