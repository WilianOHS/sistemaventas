<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Purchase;
use App\Exports\CombinedSalesAndPurchasesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SalePurchaseController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        $purchases = Purchase::all();
    
        // Combina los datos de ventas y compras en una sola colección
        $combinedData = $sales->concat($purchases);
    
        return view('admin.report.reports_sales_purchases', compact('combinedData'));
    }
    


    public function exportSalesAndPurchasesToExcel()
{
    // Recopila los datos de ventas y compras como sea necesario
    $sales = Sale::all();
    $purchases = Purchase::all();

    // Combina los datos de ventas y compras en un solo array o colección, si es necesario

    // Crea una instancia de la clase de exportación y pasa los datos combinados
    $export = new CombinedSalesAndPurchasesExport(['sales' => $sales, 'purchases' => $purchases]);

    // Genera el archivo Excel y devuelve una respuesta para descargarlo
    return Excel::download($export, 'ventas_y_compras.xlsx');
}

}
