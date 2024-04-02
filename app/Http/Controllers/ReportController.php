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
        // $totalArabicaYesterday = $this->calculateTotalArabicaBoughtForDay($yesterday) ?? 0;
        // $totalRobustaYesterday = $this->calculateTotalRobustaBoughtForDay($yesterday) ?? 0;
        // $pverAllExpenditureYesterday = $totalExpensesYesterday + $totalAdvancesYesterday + $totalArabicaYesterday + $totalRobustaYesterday;

        // $totalAdvanecesPaidYesterday = $this->calculateTotalAdvancePaidForDay($yesterday) ?? 0;
        // $totalMillingYesterday = $this->calculateTotalMIllingForDay($yesterday) ?? 0;
        // $totalMillingArabicaYesterday = $this->calculateTotalMillingArabicaForDay($yesterday) ?? 0;
        // $totalMillingRobustaYesterday = $this->calculateTotalMillingRobustaForDay($yesterday) ?? 0;

        // $totalBoxYesterday = $this->calculateTotalBoxForDay($yesterday) ?? 0;
        // $totalBoxArabicaYesterday = $this->calculateTotalBoxArabicaForDay($yesterday) ?? 0;
        // $totalBoxRobustaYesterday = $this->calculateTotalBoxRobustaForDay($yesterday) ?? 0;
        // $totalTransportYesterday = $this->calculateTotalTransportForDay($yesterday) ?? 0;
        // $totalTransportArabicaYesterday = $this->calculateTransportArabicaForDay($yesterday) ?? 0;
        // $totalTransportRobustaYesterday = $this->calculateTransportRobustaForDay($yesterday) ?? 0;
        // $totalSundryYesterday = $this->calculateTotalSundryForDay($yesterday) ?? 0;
        // $totalSundryArabicaYesterday = $this->calculateTotalSundryArabicaForDay($yesterday) ?? 0;
        // $totalSundryRobustaYesterday = $this->calculateTotalSundryRobustaForDay($yesterday) ?? 0;
        // $totalLabourYesterday = $this->calculateTotalLabourForDay($yesterday) ?? 0;
        // $totalLabourArabicaYesterday = $this->calculateTotalLabourArabicaForDay($yesterday) ?? 0;
        // $totalLabourRobustaYesterday = $this->calculateTotalLabourRobustaForDay($yesterday) ?? 0;

        // $overAllIncomeYesterday =  $totalAdvanecesPaidYesterday + $totalMillingYesterday + $totalBoxYesterday + $totalTransportYesterday + $totalSundryYesterday + $totalLabourYesterday;

        // $openingCapitalToday = $overAllIncomeYesterday - $pverAllExpenditureYesterday;



        //sum up today's capital
        // $todayCapital = Capital::whereDate('date', $date)
        //     ->where("business_id", auth()->user()->business_id)
        //     ->where("branch_id", auth()->user()->branch_id)
        //     ->sum('capital_added');


        // $totalAdvances = $this->calculateTotalAdvancesTaken($date) ?? 0;
        // $totalExpenses = $this->calculateTotalExpensesForDay($date) ?? 0;
        // $totalArabicaBought = $this->calculateTotalArabicaBoughtForDay($date) ?? 0;
        // $totalRobustaBought = $this->calculateTotalRobustaBoughtForDay($date) ?? 0;

        // $overallExpenditure = $totalExpenses + $totalAdvances + $totalArabicaBought + $totalRobustaBought;

        // $totalAdvancePaid = $this->calculateTotalAdvancePaidForDay($date) ?? 0;
        // $totalMilling = $this->calculateTotalMIllingForDay($date) ?? 0;
        // $totalMillingArabica = $this->calculateTotalMillingArabicaForDay($date) ?? 0;
        // $totalMillingRobusta = $this->calculateTotalMillingRobustaForDay($date) ?? 0;
        // $totalBox = $this->calculateTotalBoxForDay($date) ?? 0;
        // $totalBoxArabica = $this->calculateTotalBoxArabicaForDay($date) ?? 0;
        // $totalBoxRobusta = $this->calculateTotalBoxRobustaForDay($date) ?? 0;
        // $totalTransport = $this->calculateTotalTransportForDay($date) ?? 0;
        // $totalTransportArabica = $this->calculateTransportArabicaForDay($date) ?? 0;
        // $totalTransportRobusta = $this->calculateTransportRobustaForDay($date) ?? 0;
        // $totalSunDry = $this->calculateTotalSundryForDay($date) ?? 0;
        // $totalSunDryArabica = $this->calculateTotalSundryArabicaForDay($date) ?? 0;
        // $totalSunDryRobusta = $this->calculateTotalSundryRobustaForDay($date) ?? 0;
        // $totalLabour = $this->calculateTotalLabourForDay($date) ?? 0;
        // $totalLabourArabica = $this->calculateTotalLabourArabicaForDay($date) ?? 0;
        // $totalLabourRobusta = $this->calculateTotalLabourRobustaForDay($date) ?? 0;

        // $overAllIncome =  $totalAdvancePaid + $totalMilling + $totalBox + $totalTransport + $todayCapital + $openingCapitalToday + $totalSunDry + $totalLabour;

        // $netCapital = $overAllIncome - $overallExpenditure;

        //stock
        // $totalArabica = $this->calculateTotalArabicaStockForDay($date) ?? 0;
        // $totalRobusta = $this->calculateTotalRobustaStockForDay($date) ?? 0;

        // $totalStock = $totalArabica + $totalRobusta;


        return view('reports.show', [
            'date' => $date,
            // 'totalAdvances' => $totalAdvances,
            // 'totalExpenses' => $totalExpenses,
            // 'overallExpenditure' => $overallExpenditure,
            // 'totalAdvancePaid' => $totalAdvancePaid,
            // 'totalMilling' => $totalMilling,
            // 'totalMillingArabica' => $totalMillingArabica,
            // 'totalMillingRobusta' => $totalMillingRobusta,
            // 'totalBox' => $totalBox,
            // 'totalBoxArabica' => $totalBoxArabica,
            // 'totalBoxRobusta' => $totalBoxRobusta,
            // 'totalTransport' => $totalTransport,
            // 'totalTransportArabica' => $totalTransportArabica,
            // 'totalTransportRobusta' => $totalTransportRobusta,
            // 'totalSunDry' => $totalSunDry,
            // 'totalSunDryArabica' => $totalSunDryArabica,
            // 'totalSunDryRobusta' => $totalSunDryRobusta,
            // 'totalLabour' => $totalLabour,
            // 'totalLabourArabica' => $totalLabourArabica,
            // 'totalLabourRobusta' => $totalLabourRobusta,
            // 'overAllIncome' => $overAllIncome,
            // 'netCapital' => $netCapital,
            // 'totalStock' => $totalStock,
            // 'totalArabica' => $totalArabica,
            // 'totalRobusta' => $totalRobusta,
            // 'chiefBanker' => $todayCapital,
            // 'openingCapital' => $openingCapitalToday,
            // 'totalArabicaBought' => $totalArabicaBought,
            // 'totalRobustaBought' => $totalRobustaBought

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

    // private function calculateTotalMIllingForDay($date)
    // {
    //     return Balancing::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->sum('total_milling');
    // }

    // // calculate total milling arabica for a specific date  
    // private function calculateTotalMillingArabicaForDay($date)
    // {
    //     return Balancing::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->whereHas('coffeeType', function ($query) {
    //             $query->where('name', 'Arabica');
    //         })
    //         ->sum('total_milling');
    // }

    // //robusta
    // private function calculateTotalMillingRobustaForDay($date)
    // {
    //     return Balancing::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->whereHas('coffeeType', function ($query) {
    //             $query->where('name', 'Robusta');
    //         })
    //         ->sum('total_milling');
    // }




    // private function calculateTotalLabourForDay($date)
    // {
    //     return Balancing::whereDate('date', $date)
    //         ->where("business_id", auth()->user()->business_id)
    //         ->where("branch_id", auth()->user()->branch_id)
    //         ->sum('labour');
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
