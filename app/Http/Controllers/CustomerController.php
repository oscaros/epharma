<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Entity;
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

    public function sales()
    {
        //
        return view('customers.sales');
    }

    public function scan()
    {
        return view('customers.scan');
    }

    public function scanProcess(Request $request)
    {
        $phone = $request->input('phone');
        $customer = Customer::where('Phone', $phone)->first();

        if ($customer) {
            return redirect()->route('sale-items.index', ['customer_id' => $customer->id]);
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }
    public function scanProcess2(Request $request)
{
    $phone = $request->input('phone');
    $customer = Customer::where('Phone', $phone)->first();

    if ($customer) {
        return response()->json(['redirect_url' => route('sale-items.index', ['customer_id' => $customer->id])]);
    } else {
        return response()->json(['error' => 'Customer not found.'], 404);
    }
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
                'Phone' => 'required|Phone|unique:customers,Phone',
                'LastName' => 'required',
                'PInsured' => 'required',
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
                'PInsured' => $request->PInsured,
                'PType' => $request->PType,
                // 'entity_id' => $request->entity_id
                //use auth
                'entity_id' => auth()->user()->entity_id
                
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

            $this->createAudit($request, 'Created New Patient named ' . $customer->FirstName, 'Create');

            return redirect()->route('customers.index')->with('success', 'Patient created successfully.');
            // return response()->json(['data' => $customer], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
            // return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /** Display the specified resource. */
    // public function show(string $id)
    // {
    //     //
    //     return view('customers.show');
    // }

    // public function show($id)
    // {
    //     $customer = Customer::findOrFail($id);
    //     return view('customers.show', compact('customer'));
    // }

     public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            // dd($customer);
            //return entity with $customer->entity_id as its id
            $entity = Entity::find($customer->entity_id);
            
            // dd($entity);
            // return response()->json($customer);
            return view('customers.show', compact('customer', 'entity'));
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Customer not found'], 500);
             return redirect()->route('customers.index')->with('error', 'Patient not found.');
        }
    }

    public function retrieve(Request $request)
    {
        // Assume the QR code contains the customer's phone number
        $phone = $request->input('phone');

        $customer = Customer::where('Phone', $phone)->first();

        if ($customer) {
            return view('customers.show', compact('customer'));
        } else {
            return redirect()->route('customers.scan')->with('error', 'Patient not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            //code...
            $customer = Customer::find($id);
            return view('customers.edit', compact('customer'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to edit customer');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try {
            //code...
            $request->validate([
                
               
            ]);
            $customer = Customer::find($id);
           

            $data = [
                // 'Name' => $request->name,
                // 'Email' => $request->email,
                'Phone' => $request->phone,
                'Address' => $request->address,
                'UpdatedBy' => auth()->user()->id,
               
            ];

           

            $customer->update($data);
            $this->createAudit($request,  "Updated Patient with ID: {$customer->id}", 'Update', $customer->id, null);
            return redirect()->route('customers.index')->with('success', 'Patient Details updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    public function getCustomerDetails($id)
{
    $customer = Customer::findOrFail($id);
    return response()->json($customer);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
