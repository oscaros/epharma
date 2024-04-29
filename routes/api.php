<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post("registerIPN", [PaymentController::class, "registerIPN"]);
Route::get("listIPNS", [PaymentController::class, "listIPNS"]);
Route::get("completePayment", [PaymentController::class, "completePayment"]);
Route::post("processOrder", [PaymentController::class, "processOrder"]);

Route::get("finishPayment", [PaymentController::class, "finishPayment"]);
Route::get("cancelPayment", [PaymentController::class, "cancelPayment"]);

Route::post("testSendingMessages", [PaymentController::class, "testSendingMessages"]);
