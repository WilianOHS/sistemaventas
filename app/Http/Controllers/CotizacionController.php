<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\Client;
use App\Product;
use App\Business;
use Illuminate\Http\Request;
use App\Http\Requests\Cotizacion\StoreRequest;
use App\Http\Requests\Cotizacion\UpdateRequest;
use App\cotizacionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::get();
        return view('admin.cotizacion.index',compact('cotizaciones'));
    }

    public function create()
    {
        $clients = Client::get();
        $products = Product::where('status', 'ACTIVE')->get();

        return view('admin.cotizacion.create', compact('clients', 'products'));
    }
    
    public function store(StoreRequest $request)
    {
        $cotizacion = Cotizacion::create($request->all()+[
            'user_id'=>Auth::user()->id,
            'cotizacion_date'=>Carbon::now('America/El_Salvador'),
        ]);
        foreach ($request->product_id as $key => $product) {
            $results[] = array("product_id"=>$request->product_id[$key],
            "quantity"=>$request->quantity[$key], "price"=>$request->price[$key],
            "discount"=>$request->discount[$key]);
        }
        $cotizacion->cotizacionDetails()->createMany($results);

        return redirect()->route('cotizaciones.index');
    }
    public function show($id)
    {
        $cotizacion = Cotizacion::find($id);
        $subtotal = 0;
        $cotizacionDetails = $cotizacion->cotizacionDetails;
        foreach ($cotizacionDetails as $cotizacionDetail){
            $subtotal += $cotizacionDetail->quantity * $cotizacionDetail->price - (($cotizacionDetail->quantity * $cotizacionDetail->price)*($cotizacionDetail->discount/100));
        }
        return view('admin.cotizacion.show',compact('cotizacion','cotizacionDetails','subtotal'));
    }
    public function edit(Cotizacion $cotizacion)
    {
        $clients = Client::get();
        return view('admin.cotizacion.edit',compact('cotizacion'));
    }
    public function update(UpdateRequest $request, Cotizacion $cotizacion)
    {
        //$cotizacion->update($request->all());
        //return redirect()->route('sales.index');
    }
    public function destroy(Cotizacion $cotizacion)
    {
       // $cotizacion->delete();
        //return redirect()->route('sales.index');
    }

    public function pdf(Cotizacion $cotizacion)
{
    $subtotal = 0;
    $cotizacionDetails = $cotizacion->cotizacionDetails;
    foreach ($cotizacionDetails as $cotizacionDetail){
        $subtotal += $cotizacionDetail->quantity * $cotizacionDetail->price - (($cotizacionDetail->quantity * $cotizacionDetail->price)*($cotizacionDetail->discount/100));
    }
    
    // obtener el negocio relacionado con la venta actual
    $business = $cotizacion->business;
        // Obtener los datos del negocio relacionado con la venta actual
        $business1 = Business::first(); // Puedes ajustar la consulta según tus necesidades

    $pdf = PDF::loadView('admin.cotizacion.pdf', compact('business1','business', 'cotizacion', 'subtotal', 'cotizacionDetails'));
    return $pdf->download('Cotizacion_'.$cotizacion->id.'.pdf');
    
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
