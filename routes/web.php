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
use App\Mail\BoletaMailable;
use Illuminate\Support\Facades\Mail;


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
    Route::resource('roles', RolController::class)->except('show');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class)->except('show');
    Route::resource('clients', ClientController::class)->except('show');
    Route::resource('dashboard', DashboardController::class)->only('index');   
    Route::resource('companies', CompanyController::class)->except('destroy');
    Route::resource('passwords', PasswordController::class)->only('index');
    Route::resource('invoices', InvoiceController::class)->except('edit','update','destroy');
    Route::resource('voucher', VoucherController::class)->except('edit','update','destroy');

    //Cambio de contraseña
    Route::post('changePassword',[PasswordController::class, 'changePassword'])->name('changePassword');

    //Obtener precio en factura
    Route::post('precio_ajax_f', [InvoiceController::class, 'precio_ajax_f'])->name('precio_ajax_f');
    //obtener precio boleta
    Route::post('precio_ajax_b', [VoucherController::class, 'precio_ajax_b'])->name('precio_ajax_b');
    
    Route::post('invoice_send',[InvoiceController::class, 'invoice_send'])->name('invoice_send');
});

Route::get('/invoice_generate/{id}' , [InvoiceController::class, 'invoice_generate'])->name('invoice_generate')->middleware('signed');

