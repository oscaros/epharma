<?php

namespace App\Livewire;

use App\Models\Advance;
use App\Models\Balancing;
use App\Models\Capital;
use App\Models\CashPayment;
use App\Models\DeadStock;
use App\Models\Entity;
use App\Models\Product;
use App\Models\ExpenseItem;
use App\Models\Sale;
use App\Models\Sales;
use App\Models\User;
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
      
        // $currentProducts = Product::where("entity_id", auth()->user()->entity_id)
        $currentProducts = Product::all()
           
            ->latest()
            ->first();
        // $this->totalProducts = $currentProducts->quantity ?? 0;
     
    }

    public function render()
    {
        $date = $this->selectedDate;

        // Convert the passed-in date to a Carbon instance
        // $totalProducts = Product::all()->count();
        // $totalUsers = User::all()->count();
        
        // $this->totalSales = Sale::whereDate('created_at', $date)->sum('total');
        // $this->totalSales = Sale::all()->count();
        //total sales amount, sum up amount column
        if (auth()->user()->role_id == 1) {
            $this->totalUsers = User::all()->count();
            $this->totalProducts = Product::all()->count();
            $this->totalSalesAmount = Sale::all()->sum('amount');
            $this->totalInvoices = Sale::all()->count();
            $this->totalEntities = Entity::all()->count();
            $this->pendingSales = Sale::all()->where('status', 'Pending')->count();
            // $this->pendingProducts = ProductTemp::all()''
            $this->totalSales = Sale::all()->count();
        }
        else {
            //filter by entity_id
            $and = true;
            $this->totalUsers = User::query()->where('entity_id', auth()->user()->entity_id)->count();
            $this->totalProducts = Product::query()->where('entity_id', auth()->user()->entity_id)->count();
            $this->totalSalesAmount = Sale::query()->where('entity_id', auth()->user()->entity_id)->count();
            $this->pendingSales = Sale::where('entity_id', auth()->user()->entity_id)->where('status', 'Pending')->count();
            $this->totalEntities = Entity::query()->where('id', auth()->user()->entity_id)->count();
            $this->totalInvoices = Sale::query()->where('entity_id', auth()->user()->entity_id)->count();
            $this->totalSales = Sale::query()->where('entity_id', auth()->user()->entity_id)->count();
        }
    


        //convert to number
        // $this->totalProducts = count($currentProducts);
        // dd($currentProducts);
        $yesterday = Carbon::parse($date)->subDay();

       

        return view('livewire.dashboard', [
            'date' => $date,
            'pendingSales' => $this->pendingSales,
            'totalSales' => $this->totalSales,
            'totalInvoices' => $this->totalInvoices,
            'totalProducts' => $this->totalProducts,
            'totalUsers' => $this->totalUsers,
            'totalSalesAmount' => $this->totalSalesAmount,
            'totalEntities' => $this->totalEntities,


            // 'totalProducts' => $currentProducts,
        
        ]);
    }

  


}
