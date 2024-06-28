<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IPNController;
use App\Http\Controllers\YoPayments;
use App\Http\Controllers\YoPaymentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});







Route::post("registerIPN", [PaymentController::class, "registerIPN"]);
Route::get("listIPNS", [PaymentController::class, "listIPNS"]);

// Route::get('yopay', [YoPayments::class, 'makePayment']);
Route::post('yopay', [YoPayments::class, 'makePayment']);

Route::get('ipn', [YoPayments::class, 'receive_payment_notification'])->name('ipn');




// Route::post('/deposit-funds', [YoPaymentsController::class, 'depositFunds']);

Route::post('/notification', function () {
    // Handle the notification
    return response()->json(['status' => 'received']);
});

Route::post('/failure', function () {
    // Handle the failure notification
    return response()->json(['status' => 'received']);
});

Route::get("completePayment", [PaymentController::class, "completePayment"]);
Route::post("processOrder", [PaymentController::class, "processOrder"]);

Route::get("finishPayment", [PaymentController::class, "finishPayment"]);
Route::get("cancelPayment", [PaymentController::class, "cancelPayment"]);

Route::post("testSendingMessages", [PaymentController::class, "testSendingMessages"]);

Route::get('/customers/scan', [CustomerController::class, 'scan'])->name('customers.scan');
Route::post('/customers/scan', [CustomerController::class, 'scanProcess'])->name('customers.scan.process');


