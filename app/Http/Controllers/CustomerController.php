<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Traits\AuditTrait;

class CustomerController extends Controller
{

    use AuditTrait; 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            $request->validate([
                'FirstName' => 'required',
                // 'LastName' => 'required',
                'Email' => 'required|Email|unique:customers,Email',
                'Phone' => 'required',
                // 'Address' => 'required',
                // 'NIN' => 'required',
                
            ]);

           

            $data = [
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Address' => $request->Address,
                'NIN' => $request->NIN,
               
            ];

            // dd($data);

           

            $customer = Customer::create($data);

            $this->createAudit($request,  'Created New Customer named '. $customer->FirstName, 'Create');

            return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('customers.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('customers.edit');
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
