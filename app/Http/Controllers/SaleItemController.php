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
        //

        

        $customerId = $request->query('customer_id');


        // dd($customerId);
        $customer = Customer::find($customerId);

        // dd($customer);


        $sales = Sale::where('customer_id', $customerId)->get();

        // dd($sales);
        
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
