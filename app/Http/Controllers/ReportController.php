<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Balancing;
use App\Models\Capital;
use App\Models\CashPayment;
use App\Models\Customer;
use App\Models\DeadStock;
use App\Models\Expense;

use App\Models\ExpenseItem;
use App\Models\Report;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('reports.index');
    }

    public function createReport(Request $request)
    {
        // Get the date from the request, or use today's date as default
        $date = $request->input('date', now()->toDateString());

        // Convert the passed-in date to a Carbon instance
        $yesterday = Carbon::parse($date)->subDay();
        $totalAdvancesYesterday = $this->calculateCustomers($yesterday) ?? 0;
        


        $totalAdvances = $this->calculateCustomers($date) ?? 0;
       
     


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
