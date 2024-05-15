<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Balancing;
use App\Models\Capital;
use App\Models\CashPayment;
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
        // $totalAdvancesYesterday = $this->calculateTotalAdvancesTaken($yesterday) ?? 0;
        // $totalExpensesYesterday = $this->calculateTotalExpensesForDay($yesterday) ?? 0;

        // $pverAllExpenditureYesterday = $totalExpensesYesterday + $totalAdvancesYesterday + $totalArabicaYesterday + $totalRobustaYesterday;


        // $overAllIncomeYesterday =  $totalAdvanecesPaidYesterday + $totalMillingYesterday + $totalBoxYesterday + $totalTransportYesterday + $totalSundryYesterday + $totalLabourYesterday;

        // $openingCapitalToday = $overAllIncomeYesterday - $pverAllExpenditureYesterday;



        //sum up today's capital
        // $todayCapital = Capital::whereDate('date', $date)
        //     ->where("business_id", auth()->user()->business_id)
        //     ->where("branch_id", auth()->user()->branch_id)
        //     ->sum('capital_added');


        // $totalAdvances = $this->calculateTotalAdvancesTaken($date) ?? 0;
        // $totalExpenses = $this->calculateTotalExpensesForDay($date) ?? 0;
     

        // $overallExpenditure = $totalExpenses + $totalAdvances + $totalArabicaBought + $totalRobustaBought;

      


        // $overAllIncome =  $totalAdvancePaid + $totalMilling + $totalBox + $totalTransport + $todayCapital + $openingCapitalToday + $totalSunDry + $totalLabour;

        // $netCapital = $overAllIncome - $overallExpenditure;

        //stock
     


        return view('reports.show', [
            'date' => $date,
      

        ]);
    }

    // private function calculateTotalAdvancesTaken($date)
    // {
    //     return Advance::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->sum('amount');
    // }

    // // Function to calculate total expenses for a specific date
    // private function calculateTotalExpensesForDay($date)
    // {
    //     return  Expense::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->sum('amount');
    // }

    // private function calculateTotalAdvancePaidForDay($date)
    // {
    //     $balancing =  Balancing::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->where("type", "balancing")
    //         ->sum('deductable_advance') ?? 0;

    //     $cash = CashPayment::whereDate('date', $date)
    //         ->where("branch_id", auth()->user()->branch_id)

    //         ->sum('amount') ?? 0;
    //     $total = $balancing + $cash;
    //     return $total;
    // }

  

   


    // public function boxReport(Request $request)
    // {

    //     try {
    //         //code...
    //         return view('reports.boxreport');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return  $th->getMessage();
    //     }
    // }

   
}
