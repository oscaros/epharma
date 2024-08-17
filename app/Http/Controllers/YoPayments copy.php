<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Payments\YoAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;

class YoPayments extends Controller
{
    public function makePayment(Request $request)
    {
        try {
            $grandTotal = $request->grandTotal;
            dd($grandTotal);
            $productIds = json_decode($request->productIds);
            $quantities = json_decode($request->productQuantities);
            $customer_id = $request->customer_id;

            $customer = Customer::find($customer_id);
            if (!$customer) {
                throw new \Exception('Customer not found');
            }

            // Modify phone number: remove leading 0 and append 256
            $phone = $customer->Phone;
            if (Str::startsWith($phone, '0')) {
                $phone = '256' . substr($phone, 1);
            }

            $description = 'Payment of ' . $grandTotal . ' for reference number: ' . Str::uuid();
            $status = config('status.payment_status.pending');

            $sale = Sale::create([
                'product_id' => json_encode($productIds),
                'quantities' => json_encode($quantities),
                'amount' => $grandTotal,
                'user_id' => auth()->id(),
                'entity_id' => auth()->user()->entity_id,
                'reference' => Str::uuid(),
                'status' => $status,
                'description' => $description,
                'phone_number' => $customer->Phone,
                'payment_mode' => 'yo pay',
                'OrderNotificationType' => 'yo pay',
                'order_tracking_id' => Str::uuid(),
                'type' => 'Deposit',
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

            // $username = config('yopay.username'); // Load from config or env
            // $password = config('yopay.password'); // Load from config or env

            $username = '100589248779';
            $password = 'bVXo-BDBw-KF5x-JSAS-9tm0-jORW-rYqX-7EGn';

            // dd($password);

            $YoPayments = new YoAPI($username, $password);
            // $YoPayments->set_instant_notification_url(route('payment.notification')); // Define this route
            $YoPayments->set_instant_notification_url('https://webhook.site/396126eb-cc9b-4c57-a7a9-58f43d2b7935');
            // $YoPayments->set_external_reference($sale->reference);
            $YoPayments->set_external_reference(time());

            $res = $YoPayments->ac_deposit_funds($phone, $grandTotal, $description);

            // dd($res);
            // dd($res['Status']);

            $transactionReference = $res['TransactionReference'] ?? null;
            if ($transactionReference) {
                $sale->update(['reference' => $transactionReference]);
            } else {
                Log::error('YoPayments: Missing TransactionReference', ['response' => $res]);
                // throw new \Exception('Payment initiation failed. Please try again.');
                //display flash foe failure
                return redirect()->route('sales.create')->with('error', 'Payment initiation failed. Please try again.');
            }

            // dd($res['Status']);

            // Flash a success message
            

            // session()->flash('transactionReference', $transactionReference);
            session()->flash('success', 'Payment request sent successfully!');

            return redirect()->route('sales.create');
        } catch (\Exception $e) {
            Log::error('YoPayments: makePayment error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkPaymentStatus($transactionReference)
    {
        try {
            // $username = config('yopay.username'); // Load from config or env
            // $password = config('yopay.password'); // Load from config or env

            $username = '100589248779';
            $password = 'bVXo-BDBw-KF5x-JSAS-9tm0-jORW-rYqX-7EGn';

            $YoPayments = new YoAPI($username, $password);
            $statusCheck = $YoPayments->ac_transaction_check_status($transactionReference);

            $sale = Sale::where('reference', $transactionReference)->first();
            if ($sale) {
                $sale->update(['status' => $statusCheck['TransactionStatus']]);
            } else {
                Log::warning('Sale not found for transaction reference', ['reference' => $transactionReference]);
            }

            return response()->json(['status' => $statusCheck['TransactionStatus']]);
        } catch (\Exception $e) {
            Log::error('YoPayments: checkPaymentStatus error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
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
