<?php

namespace App\Http\Controllers;


use App\Sale;
use App\Product;
use App\Purchase;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\ChartJs\ChartJs;
use Caffeinated\Shinobi\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:home.index')->only(['index']);
    }

    public function index()
    {
        $comprasmes = DB::select('SELECT monthname(c.purchase_date) as mes, sum(c.total) as totalmes from purchases c where c.status="VALID" group by monthname(c.purchase_date) order by month(c.purchase_date) desc limit 12');

        $ventasmes = DB::select('SELECT monthname(v.sale_date) as mes, sum(v.total) as totalmes from sales v where v.status="VALID" group by monthname(v.sale_date) order by month(v.sale_date) desc limit 12');

        //$ventasdia = DB::select('SELECT DATE_FORMAT(v.sale_date,"%d/%m/%Y") as dia, sum(v.total) as totaldia from sales v where v.status="VALID" group by v.sale_date order by day(v.sale_date) desc limit 17');
        $ventasdia = Sale::where('status', 'VALID')->select(
            DB::raw("count(*) as count"),
            DB::raw("SUM(total) as total"),
            DB::raw("DATE_FORMAT(sale_date,'%Y-%m-%d') as date")
        )->groupBy('date')->get();
        //dd($ventasdia);
        $totales=DB::select('SELECT (select ifnull(sum(c.total),0) from purchases c where DATE(c.purchase_date)=curdate() and c.status="VALID") as totalcompra, (select ifnull(sum(v.total),0) from sales v where DATE(v.sale_date)=curdate() and v.status="VALID") as totalventa');
        //$totales=DB::select('SELECT (select ifnull(sum(c.total),0) from purchases c where DATE(month(c.purchase_date))=month(curdate()) and c.status="VALID") as totalcompra, (select ifnull(sum(v.total),0) from sales v where DATE(month(v.sale_date))=month(curdate()) and v.status="VALID") as totalventa');

        $productosvendidos=DB::select('SELECT p.code as code, 
        sum(dv.quantity) as quantity, p.name as name , p.id as id , p.stock as stock , p.category_id as category_id  from products p 
        inner join sale_details dv on p.id=dv.product_id 
        inner join categories c on p.category_id = c.id 
        inner join sales v on dv.sale_id=v.id where v.status="VALID" 
        and year(v.sale_date)=year(curdate()) 
        group by p.category_id ,p.name, p.id , p.stock order by sum(dv.quantity) desc limit 5');

        $productosmasvendidos = DB::select('SELECT 
        p.name as name, 
        sum(dv.quantity) as quantity, 
        GROUP_CONCAT(DISTINCT DATE_FORMAT(v.sale_date, "%Y-%m-%d") ORDER BY v.sale_date ASC SEPARATOR ", ") as sale_dates
        FROM products p 
        INNER JOIN sale_details dv on p.id = dv.product_id 
        INNER JOIN sales v on dv.sale_id = v.id 
        WHERE v.status = "VALID" 
        AND YEAR(v.sale_date) = YEAR(CURDATE()) 
        GROUP BY p.id 
        ORDER BY sum(dv.quantity) DESC 
        LIMIT 10');
        
        //dd($productoscategorias);
        return view('home',compact('comprasmes','ventasmes','ventasdia','totales','productosvendidos','productosmasvendidos', ));
    }
}
