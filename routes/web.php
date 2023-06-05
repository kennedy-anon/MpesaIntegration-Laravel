<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// show Mpesa payment form
Route::get('/payments', [PaymentController::class, 'mpesaCreate']);

// prompt customer for payment
Route::post('/payments/mpesa', [PaymentController::class, 'stkPush']);

// receiving mpesa calbacks/transaction receipt
Route::post('/webhooks/mpesa', [PaymentController::class, 'mpesaReceipts']);
