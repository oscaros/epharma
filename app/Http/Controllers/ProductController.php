<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\ProductTemp;
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
        $departments = Department::all();

        return view('products.create', compact('departments'));
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
                // 'Quantity' => 'required|numeric',
                // 'serial_number' => 'required',
                // 'expiry_date' => 'required|date',

                
            ]);

           

            $product =  Product::create([
                'ProductName' => $request->ProductName,
                'Insured' => $request->Insured,
                'Type' => $request->type,
                // 'price' => $request->price,
                'Price' => $request->Price,
                'Quantity' => $request->Quantity,
                'BrandNames' => $request->brand,
                'DrugClass' => $request->drug_class,
                // 'serial_number' => $request->serial_number,
                //serial number genearate as random number 8 digits
                'serial_number' => mt_rand(10000000, 99999999),
                'department_id' => $request->department_id,
                
                'entity_id' => auth()->user()->entity_id,
                'expiry_date' => $request->expiry_date,
                // 'edit_approved_by' => auth()->user()->id,
                // 'edit_approved_at' => now(),
                
            ]);
            $this->createAudit($request, 'Created Drug/Service with name - ' . $product->name, 'CREATE');
            return redirect()->route('products.index')->with('success', 'Medication added successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $departments = Department::all();
            // return response()->json($product);
            return view('products.show', compact('product', 'departments'));
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Product not found'], 500);
            return redirect()->back()->with('error', 'Product not found');
        }
    }


    public function showDetails($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found'], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);
        $departments = Department::all();
        return view('products.edit', compact('product', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'ProductName' => 'required',
            ]);

            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $quantity = $product->Quantity;
            // $new_quantity = $request->new_quantity;
            // $quantity = $old_quantity + $new_quantity;
            // $type = $request->type;
            $serial = $product->serial_number;

            $data = [
                'ProductName' => $request->ProductName,
                'Price' => $request->Price,
                'Insured' => $request->Insured,
                'serial_number' => $serial,
                // 'Quantity' => $quantity,
                // 'Type' => $type,
                'entity_id' => auth()->user()->entity_id,
                'department_id' => $request->department_id,
                'Status' => '0', // Set status to 0 during update
                'AddedBy' => auth()->user()->id,
            ];

            // dd($data);

            $product->updateOrCreate(['id' => $product->id], $data);
            // Product::updateOrCreate(['id' => $product->id], $data);

            ProductTemp::updateOrCreate(['id' => $product->id], $data);

            $this->createAudit($request,  "Updated Medication : {$product->ProductName}", 'Update');
            return redirect()->route('products.index')->with('success', 'Medication updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
