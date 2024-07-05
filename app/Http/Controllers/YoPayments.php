<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Payments\YoAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;

class YoPayments extends Controller
{
    public function makePayment(Request $request)
{
    try {
        $grandTotal = $request->grandTotal;
        $productIds = json_decode($request->productIds);
        $quantities = json_decode($request->productQuantities);
        $customer_id = $request->customer_id;

        $customer = Customer::find($customer_id);

        $description = 'Payment of ' . $grandTotal . ' for reference number: ' . Str::uuid();
        $status = config('status.payment_status.pending');

        $sale = Sale::create([
            'product_id' => json_encode($productIds),
            'quantities' => json_encode($quantities),
            'amount' => $grandTotal,
            'user_id' => auth()->id(),
            'entity_id' => 1, // Adjust as necessary
            'reference' => Str::uuid(),
            'status' => $status,
            'description' => $description,
            'phone_number' => $customer->Phone,
            'payment_mode' => 'yo pay',
            'OrderNotificationType' => 'yo pay',
            'order_tracking_id' => Str::uuid(),
            'type' => 'Wholesale',
            'payment_method' => 'yo pay',
            'customer_id' => $customer_id,
        ]);

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            if ($product) {
                SaleItem::create([
                    'SaleID' => $sale->id,
                    'ProductID' => $productId,
                    'Quantity' => $quantities[$index],
                    'Price' => $product->Price,
                    'Status' => 0
                ]);
            }
        }

        $callback_url = 'https://epharma.rapharm.shop/finishPayment';
            $cancel_url = 'https://epharma.rapharm.shop/cancelPayment';
         
            $username = '100589248779';
            $password = 'bVXo-BDBw-KF5x-JSAS-9tm0-jORW-rYqX-7EGn';
            // $externalReference = time();

        $YoPayments = new YoAPI($username, $password);
        $YoPayments->set_instant_notification_url('https://webhook.site/396126eb-cc9b-4c57-a7a9-58f43d2b7935');
        $YoPayments->set_external_reference(time());

        dd($customer->Phone);

        $res = $YoPayments->ac_deposit_funds($customer->Phone, $grandTotal, $description);

        return response()->json($res);
    } catch (Exception $e) {
        return response()->json($e->getMessage());
    }
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
