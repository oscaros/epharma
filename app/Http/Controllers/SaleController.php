<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Payments\Pesapal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // code...
            // Retrieve the grand total from the request
            $grandTotal = $request->grandTotal;

            // Retrieve product information from the request
            // $productIds = explode(',', $request->productIds);
            $productId = $request->productIds;
            // $productNames = explode(',', $request->productNames);
            // $productPrices = explode(',', $request->productPrices);

            // Save the sale to the database
            // foreach ($productIds as $key => $productId) {

            $amount = $grandTotal;

            $status = config('status.payment_status.pending');

            // $customer_name = $request->input('customer_name');
            $cashier = User::find(auth()->id());
            // $phone_number =  $request->input('phone_number');
            // $phone_number = preg_replace('/^0/','254',$phone_number);
            $phone_number = '0756741414';
            $reference = Str::uuid();

            $description = 'Payment of' . $grandTotal . ' for reference number: ' . $reference;

            // $sale =
            Sale::create([
                'product_id' => $productId,
                'amount' => $grandTotal,
                'user_id' => auth()->id(),
                'entity_id' => auth()->user()->entity_id,
                'reference' => $reference,
                'status' => $status,
                'description' => $description,
                'phone_number' => $phone_number,
                'payment_mode' => 'pesapal',
                'OrderNotificationType' => 'pesapal',
                'order_tracking_id' => $reference,
                'type' => 'Wholesale',
                'payment_method' => 'Pesapal',
                // 'product_id' => json_encode($productId)
            ]);

            $callback_url = 'https://epharma.rapharm.shop/finishPayment';
            $cancel_url = 'https://epharma.rapharm.shop/cancelPayment';

            $res = Pesapal::orderProcess($reference, $amount, $phone_number, $description, $callback_url, $cashier->name, $cashier->email, $cashier->id, $cancel_url);
            dd($res);
            dd($res->success);
            dd($res->message->redirect_url);
            if ($res->success) {
                // if($res) {
                return redirect($res->message->redirect_url);
                // return redirect('redirect_url');
            } else {
                return redirect()->back()->with('error', 'Payment Failed please try again');
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        // dd($sale);

        // session()->flash('message', 'Sale has been made successfully!');
        return redirect()->route('sales.index')->with('success', 'Sale has been made successfully!');

        // return redirect()->route('sales.index');
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
