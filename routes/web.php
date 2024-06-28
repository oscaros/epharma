<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IPNController;
use App\Http\Controllers\ListCustomerSales;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTempController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YoPayments;
use App\Http\Controllers\YoPaymentsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/customers/scan', [CustomerController::class, 'scan'])->name('customers.scan');
    Route::post('/customers/scan', [CustomerController::class, 'scanProcess'])->name('customers.scan.process');
    Route::post('yopay', [YoPayments::class, 'makePayment'])->name('yopay');

    // Route::post('/deposit-funds', [YoPaymentsController::class, 'depositFunds']);

    Route::post('/notification', function () {
        // Handle the notification
        return response()->json(['status' => 'received']);
    });

    Route::post('/failure', function () {
        // Handle the failure notification
        return response()->json(['status' => 'received']);
    });


    Route::get('/qrcode', [QRCodeController::class, 'index']);
    Route::post('/qrcode/read', [QRCodeController::class, 'read'])->name('qrcode.read');

    // Route::get('/scan-qr', 'QRCodeController@scanQR');

    Route::get('/scan-qr', [QRCodeController::class, 'scanQR']);

    // Add YoPayments Routes

    // Add other resources
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('products_temp', ProductTempController::class);
    Route::resource('entities', EntityController::class);
    Route::resource('departments', DepartmentsController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('sale-items', SaleItemController::class);
    Route::resource('customer-sales', ListCustomerSales::class);
    Route::resource('home', HomeController::class);
    Route::resource('audit-logs', AuditLogController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.delete');
    Route::post('create_report', [ReportController::class, 'createReport'])->name('create_report');
    // Route::get('ipn', [YoPayments::class, 'receive_payment_notification'])->name('ipn');
});
