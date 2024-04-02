<?php


use App\Http\Controllers\CoffeeLoadingController;
use App\Http\Controllers\DashboardController;
// Controllers
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeadStockController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTempController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CoffeePriceController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BalancingController;
use App\Http\Controllers\CoffeeTypeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ExpenseItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserStockRegistryController;
use App\Models\DeadStock;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CapitalController;
use App\Http\Controllers\CashPaymentController;
use App\Http\Controllers\CoffeePurchaseController;
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
    ROute::resource('cash', CashPaymentController::class);
    Route::get("showCashForm", [BalancingController::class, "showCashForm"])->name('showCashForm');
    Route::post("storeCashAdvance", [BalancingController::class, "storeCashAdvance"])->name('storeCashAdvance');

    Route::resource('customers', CustomerController::class);
    Route::get("getCustomers", [CustomerController::class, "getCustomers"])->name('getCustomers');

    Route::get('/get-customer-details/{id}', [CustomerController::class, 'getCustomerDetails'])->name('customer.details');

    Route::get("coffee-prices-details/{id}", [CoffeePriceController::class, "coffeePrices"])->name('coffee_prices.details');

    Route::resource('advances', AdvanceController::class);
    Route::get('advance/export/', [AdvanceController::class, 'exportAdvance'])->name('advance.export');

    Route::resource('businesses', BusinessController::class);

    Route::resource('branches', BranchController::class);

    Route::resource('products', ProductController::class);

    Route::resource('entities', EntityController::class);

    Route::resource('sales', SaleController::class);

    Route::resource('productstemp', ProductTempController::class);

    Route::resource('expenses', ExpenseController::class);

    Route::resource('dead_stock', DeadStockController::class);

    Route::get('/get-stock-added/{coffeeTypeId}', [StockController::class, 'getStockAdded'])->name('get-stock-added');




    Route::resource('expense_items', ExpenseItemController::class);
    Route::resource("expense_categories", ExpenseCategoryController::class);

    Route::resource('balancing', BalancingController::class);
    Route::get('/balancing/fetch', [BalancingController::class, 'fetchBalancing'])->name('balancing.fetch');
    Route::get('balancing/export/', [BalancingController::class, 'exportBalancing'])->name('balancing.export');

    Route::resource('coffee_types', CoffeeTypeController::class);
    Route::resource('coffee_loadings', CoffeeLoadingController::class);
    Route::resource('coffee_purchases', CoffeePurchaseController::class);

    Route::resource('coffee_prices', CoffeePriceController::class);

    Route::resource('home', HomeController::class);

    Route::resource('stocks', StockController::class);
    Route::get("getDeadStockCoffee/{id}", [StockController::class, "getDeadStockCoffee"])->name('getDeadStockCoffee');

    Route::resource('expense_items', ExpenseItemController::class);

    Route::resource('settings', SettingController::class);

    Route::resource('user-profile', UserProfileController::class);

    Route::resource('user-stock-registry', UserStockRegistryController::class);

    Route::resource('audit-logs', AuditLogController::class);

    Route::resource('capital', CapitalController::class);

    Route::resource('reports', ReportController::class);

    Route::get('/customer/{id}/advances', [CustomerController::class, "advances"])->name('customer.advances');
    Route::get('/customer/{id}/balancing', [CustomerController::class, "balancing"])->name('customer.balancing');
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.delete');


    Route::get("ledger/{id}/ledger", [CustomerController::class, "ledger"])->name("customer.ledger");
    Route::get('/customer/{customerId}/ledger', [LedgerController::class, 'getLedgerData']);

    Route::get('/expense_items', [ExpenseItemController::class, 'index'])->name('expense_items.index');
    //return data of expense items
    Route::get('/expense_items_data', [ExpenseItemController::class, 'getExpenseItems']);
    Route::get("/capital_data", [CapitalController::class, 'getCapitalData']);

    Route::post("create_report", [ReportController::class, "createReport"])->name('create_report');




    // add route for roles resource and permissions resource
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('sample', 'SampleController@index');
    Route::post('sample/export', 'SampleController@index');

    Route::post(
        'expenses/expense-items',
        [ExpenseController::class, 'getExpenseItems']
    )->name('expenses.expense-items');
    //here

});
