<?php

namespace App\Livewire;

use App\Models\Advance;
use App\Models\Balancing;
use App\Models\Capital;
use App\Models\CashPayment;
use App\Models\DeadStock;
use App\Models\Product;
use App\Models\ExpenseItem;
use App\Models\Sales;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $selectedDate;
    public $totalProducts;
    public $totalSales;
    public $totalInvoices;
    public $pendingProducts;
   
    public $successMessage = '';

    public $yesterday;

    public $overAllIncomeYesterday;




    //a day before calculations

    public function mount()
    {
        // Set default date to today
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function applyFilter()
    {
        $date = $this->selectedDate;
      
        $currentProducts = Product::where("entity_id", auth()->user()->entity_id)
           
            ->latest()
            ->first();
        $this->totalProducts = $currentProducts->quantity ?? 0;
     
    }

    public function render()
    {
        $date = $this->selectedDate;

        // Convert the passed-in date to a Carbon instance
        $yesterday = Carbon::parse($date)->subDay();
       

        return view('livewire.dashboard', [
            'date' => $date,
            'pendingProducts' => $this->pendingProducts,
            'totalSales' => $this->totalSales,
            'totalInvoices' => $this->totalInvoices,
            'totalProducts' => $this->totalProducts,
        
        ]);
    }

  


}
