<?php

namespace App\Http\Controllers;

use App\Models\ProductTemp;
use App\Traits\AccessTrait;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;

class ProductTempController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AccessTrait;
    use AuditTrait;
    public function index()
    {
        //
        return view('products_temp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                'ProductName' => 'required',
                // 'price' => 'required|numeric',
                'Quantity' => 'required|numeric',
                // 'serial_number' => 'required',
                'expiry_date' => 'required|date',

                
            ]);

            // dd($request->all());

           

            $product =  ProductTemp::create([
                'ProductName' => $request->ProductName,
                // 'price' => $request->price,
                'Price' => $request->Price,
                'Quantity' => $request->Quantity,
                'NewQuantity' => $request->new_quantity,
                'BrandNames' => $request->brand,
                'DrugClass' => $request->drug_class,
                // 'serial_number' => $request->serial_number,
                //serial number genearate as random number 8 digits
                // 'serial_number' => mt_rand(10000000, 99999999),
                'serial_number' => $request->serial_number,
                //status set to pending default
                'status' => 'Pending',
                
                'entity_id' => auth()->user()->entity_id,
                'expiry_date' => $request->expiry_date,
                // 'edit_approved_by' => auth()->user()->id,
                // 'edit_approved_at' => now(),
                
            ]);
            $this->createAudit($request, 'Created Updated with name - ' . $product->name, 'CREATE');
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
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
