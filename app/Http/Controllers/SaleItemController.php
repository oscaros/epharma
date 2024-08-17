<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // $saleId = $request->query('id');
        //TODO: pick sale id, pick sale items belonging to sale id, return and compact to view , change view
        // $saleItems = SaleItem::find($saleId);

        

        $customerId = $request->query('customer_id');
        $customer = Customer::find($customerId);
        $sales = Sale::where('customer_id', $customerId)->get();    
        
        return view('sale-items.index', compact('customer', 'sales'));


        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sale-items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleItem $saleItem)
    {
        //
        return view('sale-items.show', compact('saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItem $saleItem, Request $request)
    {
        //
        return view('sale-items.edit', compact('saleItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        //
    }



    public function fetchByCustomer($customerId)
    {
        $salesItems = SaleItem::with(['product', 'sale'])
            ->whereHas('sale', function($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->where('created_at', '>=', now()->subDay())
            ->get()
            ->map(function ($item) {
                // Enrich the data with product name directly
                $item->ProductName = $item->product ? $item->product->ProductName : 'N/A';
                return $item;
            });
    
        return response()->json($salesItems);
    }


 



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
