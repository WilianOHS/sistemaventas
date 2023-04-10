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



Route::resource('users', UserController::class)->names('users');

Route::resource('roles', RoleController::class)->names('roles');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/login', [LoginController::class, 'logout']);
