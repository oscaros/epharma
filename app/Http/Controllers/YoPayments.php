<?php

namespace App\Http\Controllers;

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

            // Retrieve product information from the request
            // $productIds = explode(',', $request->productIds);
            $productIds = json_decode($request->productIds);
            $quantities = json_decode($request->productQuantities);

            $phone_number = '0753138675';
            $amount = '5000';
            $reference = Str::uuid();
            // $customer_id = $request->input('customer_id');
            // $customer_id = $request->customer_id;
            $customer_id = 1;


            $description = 'Payment of ' . $grandTotal . ' for reference number: ' . $reference;

            $status = config('status.payment_status.pending');




            // $sale =
            $sale = Sale::create([
                'product_id' => json_encode($productIds),
                'quantities' => json_encode($quantities),
                'amount' => $amount,
                'user_id' => auth()->id(),
                // 'entity_id' => auth()->user()->entity_id,
                'entity_id' => 1,
                'reference' => $reference,
                'status' => $status,
                'description' => $description,
                'phone_number' => $phone_number,
                'payment_mode' => 'yo pay',
                'OrderNotificationType' => 'yo pay',
                'order_tracking_id' => $reference,
                'type' => 'Wholesale',
                'payment_method' => 'yo pay',
                'customer_id' => $customer_id,
                // 'product_id' => json_encode($productId)
            ]);

            // dd($customer_id);

            // dd($sale);




             // Create Sale Items
             // Create Sale Items
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
            $externalReference = time();
            // $number = 256756741414;

            $YoPayments = new YoAPI($username, $password);
            $YoPayments->set_instant_notification_url('https://webhook.site/396126eb-cc9b-4c57-a7a9-58f43d2b7935');
            $YoPayments->set_external_reference($externalReference);

            $amount = 10000.00;
            $msisdn = '256756741414';
            $narrative = 'Success Payment';

            $res = $YoPayments->ac_deposit_funds($msisdn, $amount, $narrative);

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
