<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\Product;
use App\Business;
use Illuminate\Http\Request;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Requests\Sale\UpdateRequest;
use App\saleDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Exports\SaleExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sales.create')->only(['create','store']);
        $this->middleware('can:sales.index')->only(['index']);
        $this->middleware('can:sales.show')->only(['show']);

        $this->middleware('can:change.status.sales')->only(['change_status']);
        $this->middleware('can:sales.pdf')->only(['pdf']);
        $this->middleware('can:sales.print')->only(['print']);
        $this->middleware('can:sales.exportar')->only(['exportar']);
    }
    
    public function index()
    {
        $sales = Sale::get();
        return view('admin.sale.index',compact('sales'));
    }
    public function create()
    {
        $clients = Client::get();
        //$products = Product::get();
        $products = Product::where('status', 'ACTIVE')->get();
        return view('admin.sale.create',compact('clients','products'));
    }
    public function store(StoreRequest $request)
    {
        $sale = Sale::create($request->all()+[
            'user_id'=>Auth::user()->id,
            'sale_date'=>Carbon::now('America/El_Salvador'),
        ]);
        foreach ($request->product_id as $key => $product) {
            $results[] = array("product_id"=>$request->product_id[$key],
            "quantity"=>$request->quantity[$key], "price"=>$request->price[$key],
            "discount"=>$request->discount[$key]);
        }
        $sale->saleDetails()->createMany($results);

        return redirect()->route('sales.index');
    }
    public function show(Sale $sale)
    {
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail){
            $subtotal += $saleDetail->quantity * $saleDetail->price - (($saleDetail->quantity * $saleDetail->price)*($saleDetail->discount/100));
        }
        return view('admin.sale.show',compact('sale','saleDetails','subtotal'));
    }
    public function edit(Sale $sale)
    {
        $clients = Client::get();
        return view('admin.sale.edit',compact('sale'));
    }
    public function update(UpdateRequest $request, Sale $sale)
    {
        //$sale->update($request->all());
        //return redirect()->route('sales.index');
    }
    public function destroy(Sale $sale)
    {
       // $sale->delete();
        //return redirect()->route('sales.index');
    }

    public function pdf(Sale $sale)
{
    $subtotal = 0;
    $saleDetails = $sale->saleDetails;
    foreach ($saleDetails as $saleDetail){
        $subtotal += $saleDetail->quantity * $saleDetail->price - (($saleDetail->quantity * $saleDetail->price)*($saleDetail->discount/100));
    }
    
    // obtener el negocio relacionado con la venta actual
    $business = $sale->business;
    
    $pdf = PDF::loadView('admin.sale.pdf', compact('business', 'sale', 'subtotal', 'saleDetails'));
    return $pdf->download('Reporte_de_venta_'.$sale->id.'.pdf');
    
}

public function ticket(Sale $sale)
{
    $subtotal = 0;
    $saleDetails = $sale->saleDetails;
    foreach ($saleDetails as $saleDetail){
        $subtotal += $saleDetail->quantity * $saleDetail->price - (($saleDetail->quantity * $saleDetail->price)*($saleDetail->discount/100));
    }
    
    // Obtener los datos del negocio relacionado con la venta actual
    $business = Business::first(); // Puedes ajustar la consulta según tus necesidades
    
    // Convertir la fecha a un objeto Carbon
    $saleDate = Carbon::parse($sale->sale_date);
    
     try {
        $printer_name = $sale->printer->name;
         $connector = new WindowsPrintConnector($printer_name);
         $printer = new Printer($connector);
        
         // Establecer los ajustes del formato de impresión
         $printer->setJustification(Printer::JUSTIFY_CENTER);
        
         // Imprimir el contenido del ticket
         $printer->text("Fecha: " . $saleDate->format('d/m/Y h:i A') . "\n");
         $printer->text($business->name . "\n");
         $printer->text($business->address . "\n");
         $printer->text("Tel: " . $business->number . "\n");
        
    //     // ... Más contenido del ticket ...
        
         $printer->cut();
         $printer->close();
        
        return view('admin.sale.ticket', compact('sale', 'saleDetails', 'subtotal', 'business', 'saleDate'));
     } catch (\Throwable $th) {
         return redirect()->back();
     }
}




    public function print(Sale $sale){
        try {
            $subtotal = 0;
            $saleDetails = $sale->saleDetails;
            foreach ($saleDetails as $saleDetail){
            $subtotal += $saleDetail->quantity * $saleDetail->price - (($saleDetail->quantity * $saleDetail->price)*($saleDetail->discount/100));
            }

            $printer_name = "Epson TM-T20";

            $connector = new WindowsPrintConnector($printer_name);
            $printer = new Printer($connector);

            $printer->text("€ 9,95\n");

            $printer->cut();
            $printer->close();

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        
    }
    public function change_status(Sale $sale)
    {
        if ($sale->status == 'VALID') {
            $sale->update(['status'=> 'CANCELED']);
            return redirect()->back();
        }else {
            $sale->update(['status'=> 'VALID']);
            return redirect()->back();
        }
    }
    public function exportar(){
        //return "hola mundo";
        return Excel::download(new SaleExport, 'ventas.xlsx');
    }
    public function storeClient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'dui' => 'nullable|unique:clients',
            'address' => 'nullable',
            'phone' => 'nullable|unique:clients',
            'email' => 'nullable|email|unique:clients',
        ], [
            'dui.unique' => 'Este DUI ya está registrado en la base de datos',
            'phone.unique' => 'Este número de teléfono ya está registrado en la base de datos',
            'email.unique' => 'Este correo electrónico ya está registrado en la base de datos',
        ]);
        $client = Client::create([
            'name' => $request->input('name'),
            'dui' => $request->input('dui'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);
        
        //return view('clients.success', ['client' => $client]);
        return redirect()->back()->with('success', 'Cliente registrado con éxito!');

    }
}
