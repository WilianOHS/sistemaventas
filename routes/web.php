<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('sales/reports_day', 'ReportController@reports_day')->name('reports.day');
Route::get('sales/reports_date', 'ReportController@reports_date')->name('reports.date');

Route::post('sales/report_results', 'ReportController@report_results')->name('report.results');

Route::get('/prueba', function () {
    return view('prueba');
});

Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('clients', ClientController::class)->names('clients');
Route::resource('products', ProductController::class)->names('products');
Route::resource('providers', ProviderController::class)->names('providers');
Route::resource('purchases', PurchaseController::class)->names('purchases')->except([
    'edit', 'update', 'destroy'
]);
Route::resource('sales', SaleController::class)->names('sales')->except([
    'edit', 'update', 'destroy'
]);
Route::get('purchases/pdf/{purchase}', 'PurchaseController@pdf')->name('purchases.pdf');

Route::get('sales/pdf/{sale}', 'SaleController@pdf')->name('sales.pdf');

Route::get('sales/print/{sale}', 'SaleController@print')->name('sales.print');

Route::get('sales/ticket/{sale}', 'SaleController@ticket')->name('sales.ticket');
Route::get('sales/envoice/{sale}', 'SaleController@envoice')->name('sales.envoice');
Route::get('sales/tax_credit/{sale}', 'SaleController@tax_credit')->name('sales.tax_credit');

Route::get('exportar/', 'SaleController@exportar')->name('sales.exportar');

Route::resource('business', BusinessController::class)->names('business')->only([
    'index', 'update'
]);;

Route::resource('printers', PrinterController::class)->names('printers')->only([
    'index', 'update'
]);;

Route::get('purchases/upload/{purchase}', 'PurchaseController@upload')->name('upload.purchases');

Route::get('change_status/products/{product}', 'ProductController@change_status')->name('change.status.products');
Route::get('change_status/purchases/{purchase}', 'PurchaseController@change_status')->name('change.status.purchases');
Route::get('change_status/sales/{sale}', 'SaleController@change_status')->name('change.status.sales');

Route::get('/get-filtered-data', 'HomeController@getFilteredData')->name('getFilteredData');

Route::get('ruta/para/filtrar', [HomeController::class, 'filtrar']);

Route::post('/sales/store-client', 'SaleController@storeClient')->name('sales.storeClient');

Route::post('/cotizaciones/store-client', 'CotizacionController@storeClient')->name('cotizaciones.storeClient');

Route::resource('users', UserController::class)->names('users');

Route::resource('roles', RoleController::class)->names('roles');

Route::resource('cashopening', CashOpeningController::class)->names('cashopening');
Route::resource('cashclosing', CashClosingController::class)->names('cashclosing');
Route::resource('cashclosingz', CashClosingzController::class)->names('cashclosingz');


Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('get_products_by_barcode', 'ProductController@get_products_by_barcode')->name('get_products_by_barcode');

Route::get('get_products_by_id', 'ProductController@get_products_by_id')->name('get_products_by_id');
Route::get('get-by-barcode', 'ProductController@getProductByBarcode')->name('get_product_by_barcode');

Route::get('/get-latest-document-number', 'SaleController@getLatestDocumentNumber');

Route::resource('cotizaciones', CotizacionController::class)->names('cotizaciones')->except([
    'edit', 'update', 'destroy'
]);

Route::get('/reports-sales-purchases', 'SalePurchaseController@index')->name('reports_sales_purchases.index');

Route::get('/export-sales-purchases', 'SalePurchaseController@exportSalesAndPurchasesToExcel')->name('export_sales_and_purchases');


Route::get('cotizaciones/pdf/{cotizacion}', 'CotizacionController@pdf')->name('cotizaciones.pdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/login', [LoginController::class, 'logout']);
