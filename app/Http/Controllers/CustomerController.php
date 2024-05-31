<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
            // code...
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

            // Generate QR code with phone number
            $qrCode = QrCode::format('png')->generate($customer->Phone);

            // Store QR code in the public directory
            $fileName = 'qrcodes/' . $customer->id . '.png';
            Storage::disk('public')->put($fileName, $qrCode);

            // Save QR code file path in the database
            $customer->qr_code_path = $fileName;
            $customer->save();

            $this->createAudit($request, 'Created New Customer named ' . $customer->FirstName, 'Create');

            return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /** Display the specified resource. */
    // public function show(string $id)
    // {
    //     //
    //     return view('customers.show');
    // }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

   
    


    public function retrieve(Request $request)
    {
        // Assume the QR code contains the customer's phone number
        $phone = $request->input('phone');

        $customer = Customer::where('Phone', $phone)->first();

        if ($customer) {
            return view('customers.show', compact('customer'));
        } else {
            return redirect()->route('customers.scan')->with('error', 'Customer not found.');
        }
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
