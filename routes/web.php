<?php



use App\Http\Controllers\DashboardController;
// Controllers
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\EntityController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTempController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditLogController;

use App\Http\Controllers\ReportController;


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

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {

    // Route::resource('users', UserController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get("millingReport", [ReportController::class, "millingReport"])->name('millingReport');
    
    Route::get("boxReport", [ReportController::class, "boxReport"])->name('boxReport');
    Route::get("transportReport", [ReportController::class, "transportReport"])->name('transportReport');
    Route::get("sundryReport", [ReportController::class, "sundryReport"])->name('sundryReport');
    Route::get("labourReport", [ReportController::class, "labourReport"])->name('labourReport');


    //here
    Route::resource('users', UserController::class);


    Route::resource('customers', CustomerController::class);
    Route::get("getCustomers", [CustomerController::class, "getCustomers"])->name('getCustomers');

    Route::get('/get-customer-details/{id}', [CustomerController::class, 'getCustomerDetails'])->name('customer.details');

  

    Route::resource('products', ProductController::class);

    Route::resource('entities', EntityController::class);

    Route::resource('sales', SaleController::class);

    Route::resource('productstemp', ProductTempController::class);

   

    Route::resource('home', HomeController::class);

 
    Route::resource('audit-logs', AuditLogController::class);


    Route::resource('reports', ReportController::class);

    Route::get('/customer/{id}/advances', [CustomerController::class, "advances"])->name('customer.advances');
    Route::get('/customer/{id}/balancing', [CustomerController::class, "balancing"])->name('customer.balancing');
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.delete');


    Route::get("ledger/{id}/ledger", [CustomerController::class, "ledger"])->name("customer.ledger");
    

    Route::post("create_report", [ReportController::class, "createReport"])->name('create_report');




    // add route for roles resource and permissions resource
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('sample', 'SampleController@index');
    Route::post('sample/export', 'SampleController@index');

    // Route::post(
    //     'expenses/expense-items',
    //     [ExpenseController::class, 'getExpenseItems']
    // )->name('expenses.expense-items');
    //here

});
