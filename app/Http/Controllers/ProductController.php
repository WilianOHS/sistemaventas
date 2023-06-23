<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Provider;
use App\Business;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:product.create')->only(['create','store']);
        $this->middleware('can:product.index')->only(['index']);
        $this->middleware('can:product.edit')->only(['edit','update']);
        $this->middleware('can:product.show')->only(['show']);
        $this->middleware('can:product.destroy')->only(['destroy']);

        $this->middleware('can:change.status.products')->only(['change_status']);
    }
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();   
        return view('admin.product.create',compact('categories','providers'));
    }
    public function store(StoreRequest $request)
{
    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $image_name = time().'_'.$file->getClientOriginalName();
        $file->move(public_path("/image"), $image_name);
    } else {
        $business = Business::first(); // Obtener el primer registro de la tabla businesses
        $image_name = $business->logo; // Obtener el nombre del logo desde el campo logo de la tabla businesses
    }

    $product = Product::create($request->all()+[
        'image' => $image_name,
    ]);

    if($request->code == ""){
        $product->update(['code'=>$product->id]);
    }

    return redirect()->route('products.index');
}
    
    
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }
    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();   
        return view('admin.product.edit',compact('product', 'categories','providers'));
    }
    public function update(UpdateRequest $request, Product $product)
    {
        $image_name = $product->image;
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"),$image_name);
        }
        $product->update($request->all()+[
            'image' =>$image_name,
        ]);
        return redirect()->route('products.index');
    }    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status'=> 'DEACTIVATED']);
            return redirect()->back();
        }else {
            $product->update(['status'=> 'ACTIVE']);
            return redirect()->back();
        }
    }
    public function get_products_by_barcode(Request $request){
        if ($request->ajax()) {
            $products = Product::where('code', $request->code)->firstOrFail();
            return response()->json($products);
        }
    }
    public function get_products_by_id(Request $request){
        if ($request->ajax()) {
            $products = Product::findOrFail($request->product_id);
            return response()->json($products);
        }
    }
    public function getProductByBarcode(Request $request)
{
    if ($request->ajax()) {
        $product = Product::where('code', $request->code)->first();

        if ($product) {
            return response()->json([
                'id' => $product->id,
                'stock' => $product->stock,
                'sale_price' => $product->sale_price
            ]);
        } else {
            return response()->json(null);
        }
    }
}

}
