<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     use AuditTrait;
    public function index()
    {
        //
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            //
            $request->validate([
                'name' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                // 'serial_number' => 'required',
                'expiry_date' => 'required|date',

                
            ]);

           

            $product =  Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                // 'serial_number' => $request->serial_number,
                //serial number genearate as random number 8 digits
                'serial_number' => mt_rand(10000000, 99999999),
                
                'entity_id' => auth()->user()->entity_id,
                'expiry_date' => $request->expiry_date,
                // 'edit_approved_by' => auth()->user()->id,
                // 'edit_approved_at' => now(),
                
            ]);
            $this->createAudit($request, 'Created Product with name - ' . $product->name, 'CREATE');
            return redirect()->route('products.index')->with('success', 'Product added successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
