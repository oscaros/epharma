<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {

        $totalCustomers = Customer::where("entity_id", auth()->user()->entity_id)->count();
        $totalSales = Sale::where("entity_id", auth()->user()->entity_id)->count();
        $totalInvoices = Sale::where("entity_id", auth()->user()->entity_id)->count();
        $totalSalesAmount = Sale::where("entity_id", auth()->user()->entity_id)->sum('amount');
        $pendingInvoices = Sale::where("entity_id", auth()->user()->entity_id)->where('status', 'Pending')->count();
        $totalProducts = Product::where("entity_id", auth()->user()->entity_id)->count();
        $totalUsers = User::where("entity_id", auth()->user()->entity_id)->count();
        $totalDrugs = Product::where("entity_id", auth()->user()->entity_id)->where('type', 'Drug')->count();
        $totalServices = Product::where("entity_id", auth()->user()->entity_id)->where('type', 'Service')->count();
  
        $totalServicePoints = Department::where("entity_id", auth()->user()->entity_id)->count();
        return view('reports.index', compact('totalCustomers', 'totalSales', 'totalInvoices', 'totalSalesAmount', 'pendingInvoices', 'totalProducts', 'totalUsers', 'totalDrugs', 'totalServices', 'totalCustomers', 'totalServicePoints'));
    }

    public function createReport(Request $request)
    {
        // Get the date from the request, or use today's date as default
        $date = $request->input('date', now()->toDateString());

        // Convert the passed-in date to a Carbon instance
        $yesterday = Carbon::parse($date)->subDay();
        $totalCustomersYesterday = $this->calculateCustomers($yesterday) ?? 0;
        


        $totalCustomers = $this->calculateCustomers($date) ?? 0;
       
     


        return view('reports.show', [
            'date' => $date,
      

        ]);
    }

    private function calculateCustomers($date)
    {
        return Customer::whereDate('date', $date)
            ->where("entity_id", auth()->user()->entity_id);
            // ->where("branch_id", auth()->user()->branch_id)
            // ->sum('amount');
    }

  

   
}
