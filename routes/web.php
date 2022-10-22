<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VoucherController;
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
    return view('auth.login');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'prevent-back-history']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', RolController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('passwords', PasswordController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('vouchers', VoucherController::class);

    //Cambio de contraseña
    Route::post('changePassword',[PasswordController::class, 'changePassword'])->name('changePassword');

    //Obtener precio en factura
    Route::post('precio_ajax_f', [InvoiceController::class, 'precio_ajax_f'])->name('precio_ajax_f');

});
