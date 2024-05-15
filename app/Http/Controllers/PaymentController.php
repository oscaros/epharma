<?php

namespace App\Http\Controllers;

use App\Mail\DonationNotification;

use App\Models\Customer;

use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use App\Payments\Pesapal;
use App\Traits\MessageTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    use MessageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("payments.index");
    }


    public function finishPayment(Request $request)
    {
        try {
            //code...
            $orderTrackingId = $request->input('OrderTrackingId');
            $reference = $request->input('OrderMerchantReference');

            Sale::where("reference", $reference)->update([
                "order_tracking_id" => $orderTrackingId,

            ]);
            //get the actual transaction
            $transaction = Sale::where("reference", $reference)->first();
            // $cashier = User::find($transaction->user_id);
            $cashier = User::find(auth()->user()->id);
            $data = Pesapal::transactionStatus($orderTrackingId, $orderTrackingId);
            $payment_method = $data->message->payment_method;

            // $name =  $customer->first_name . " " . $customer->last_name;
            // $email = $customer->email;
            $email = $cashier->email;
            $name = $cashier->name;

            if ($data->message->payment_status_description == config("status.payment_status.completed")) {
                $message = "Hello {$name} your payment of {$transaction->amount} has been successfully completed.Thank you";
                $this->sendMessage($cashier->phone_number, $message);
                //check if the transaction is already completed
                if ($transaction->status == config("status.payment_status.completed")) {
                    // Send donation email to existing user
                    // if ($transaction->type == "Retail") {
                        //update all babies to sponsored
                        //TODO:
                        //update sales table
                        Sale::update([
                            "status" => 1
                        ]);
                    // } 
                  
                        }
                     
                    Mail::to($email)->send(new DonationNotification("Payment Successful", $name, $transaction->amount, $transaction->status));
                    return redirect()->route('sales.index');
                } else {
                    Mail::to($email)->send(new DonationNotification("Payment Failed", $name, $transaction->amount, $transaction->status));
                    return redirect()->route('sales.index');
                


                $transaction->update([
                    "status" => config("status.payment_status.failed"),
                    "payment_method" => $payment_method
                ]);
                Mail::to($email)->send(new DonationNotification("Payment Failed", $name, $transaction->amount, $transaction->status));

                return redirect()->route('login');
            }
        } catch (\Throwable $th) {
            Log::info("===========finish payment===================================");
            Log::error($th->getMessage());
            Log::info("============finishh payment==================================");

            return redirect()->route('sales.index');
        }
    }

    public function registerIPN(Request $request)
    {
        try {
            //add validation for url is registered
            $request->validate([
                'url' => 'required|string'
            ]);


            return Pesapal::pesapalRegisterIPN($request->url);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function listIPNS(Request $request)
    {
        try {
            $data = Pesapal::listIPNS();
            return response()->json(['success' => true, 'message' => 'Success', 'response' => $data]);
        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function cancelPayment(Request $request)
    {
        try {
            $payment_reference =  $request->input("payment_reference");
            $transaction = Sale::where("reference", $payment_reference)->first();
            Sale::where("reference", $payment_reference)->update([
                "status" => "Failed"
            ]);
            $customer = User::find($transaction->sponsor_id);
            $name =  $customer->name;
            $email = $customer->email;
            // if ($transaction->child_ids) {
                //do magic
                // $childIds = json_decode($transaction->child_ids);
                // foreach ($childIds as $childId) {
                    // $child = Children::find($childId);
                    Sale::create([
                        'reference' => $transaction->reference,
                        'amount' => $transaction->amount,
                        'sponsor_id' => $transaction->sponsor_id,
                        'status' => "Failed",
                        'description' => $transaction->description,
                        'phone_number' => $transaction->phone_number,
                        'payment_mode' => $transaction->payment_mode,
                        'OrderNotificationType' => $transaction->OrderNotificationType,
                        'order_tracking_id' => $transaction->order_tracking_id,
                        'type' => $transaction->type,
                        'payment_method' => $transaction->payment_method,
                        'user_id' => $transaction->user_id,
                        // 'child_id' => $childId
                    ]);
                   
                
            

            Mail::to($email)->send(new DonationNotification("Payment Failed", $name, $transaction->amount, $transaction->status));
            return view("sales.index");
        } catch (\Throwable $th) {
            Log::info("===========cancel payment===================================");
            Log::error($th->getMessage());
            Log::info("============cancel payment==================================");
            return view("home");
        }
    }

    public function completePayment(Request $request)
    {
        try {
            Log::info("===========The call back was called===================================");
            Log::info("Received Response Page");
            Log::info("============The call back was called==================================");
            // Get the parameters from the URL
            $orderTrackingId = $request->input('OrderTrackingId');
            $orderMerchantReference = $request->input('OrderMerchantReference');

            $orderNotificationType = $request->input('OrderNotificationType');
            Sale::where("reference", $orderMerchantReference)->update([
                "order_tracking_id" => $orderTrackingId,
                "orderNotificationType" => $orderNotificationType
            ]);

            $transaction = Sale::where("reference", $orderMerchantReference)->first();
            if (!$transaction) {
                return response()->json([
                    "status" => 500,
                    "message" => "Sale not found"
                ]);
            }
            $customer = User::find(auth()->user()->id);
            $data = Pesapal::transactionStatus($orderTrackingId, $orderMerchantReference);
            // return $data;
            $payment_method = $data->message->payment_method;
            $name =  $customer->name;
            $email = $customer->email;

            Log::info("=========================================call back executed=============================================================================================================");
            Log::info("Received Response Page - Order Tracking ID: $orderTrackingId, Merchant Reference: $orderMerchantReference, Notification Type: $orderNotificationType");
            Log::info("==========================================call back executed============================================================================================================");

            if ($data->message->payment_status_description == config("status.payment_status.completed")) {
                $message = "Hello {$name} your payment of {$transaction->amount} has been successfully completed.Thank you";
                $this->sendMessage($customer->phone_number, $message);

                //check if the transaction is already completed
                if ($transaction->status == config("status.payment_status.completed")) {
                 
                                Sale::create([
                                    'reference' => $transaction->reference,
                                    'amount' => $transaction->amount,
                                    'sponsor_id' => $transaction->sponsor_id,
                                    'status' => "Completed",
                                    'description' => $transaction->description,
                                    'phone_number' => $transaction->phone_number,
                                    'payment_mode' => $transaction->payment_mode,
                                    'OrderNotificationType' => $transaction->OrderNotificationType,
                                    'order_tracking_id' => $transaction->order_tracking_id,
                                    'type' => $transaction->type,
                                    'payment_method' => $transaction->payment_method,
                                    'user_id' => $transaction->user_id,
                                   
                                ]);
                              
                            
                     
                    }
                    Mail::to($email)->send(new DonationNotification("Payment Successful", $name, $transaction->amount, $transaction->status));
                    return response()->json([
                        "status" => 200,
                        "message" => "Transaction already completed"
                    ]);
                } 
                // else  {
                       
                //                 Sale::create([
                //                     'reference' => $transaction->reference,
                //                     'amount' => $transaction->amount,
                //                     'sponsor_id' => $transaction->sponsor_id,
                //                     'status' => $transaction->status,
                //                     'description' => $transaction->description,
                //                     'phone_number' => $transaction->phone_number,
                //                     'payment_mode' => $transaction->payment_mode,
                //                     'OrderNotificationType' => $transaction->OrderNotificationType,
                //                     'order_tracking_id' => $transaction->order_tracking_id,
                //                     'type' => $transaction->type,
                //                     'payment_method' => $transaction->payment_method,
                //                     'user_id' => $transaction->user_id,
                                  
                //                 ]);
                              
                       
                //     Mail::to($email)->send(new DonationNotification("Payment Successful", $name, $transaction->amount, $transaction->status));
                //     $transaction->update([
                //         "status" => "completed",
                //         "payment_method" => $payment_method
                //     ]);

                //     return response()->json([
                //         "status" => 200,
                //         "message" => "Transaction completed"
                //     ]);
                // }
            // } 
            else {
                Mail::to($email)->send(new DonationNotification("Payment Failed", $name, $transaction->amount, $transaction->status));
                return response()->json([
                    "status" => 500,
                    "message" => "Transaction failed"
                ]);
            }
        } catch (\Throwable $th) {

            Log::info("===========callback url==================================");
            Log::error($th->getMessage());
            Log::info("============call back url=================================");
            return response()->json(['success' => false, 'message' => $th->getMessage(), "status" => 500]);
        }
    }

    public function processOrder(Request $request)
    {
        try {
            //$amount, $phone, $callback
            $request->validate([
                'amount' => 'required|numeric',
                'phone_number' => 'required|string',
                'callback' => 'required|string',
                'payment_phone_number' => 'required|string',
                'cancel_url' => 'required|string'
            ]);
            $getCustomer =  User::where('phone', $request->phone_number)->first();
            if (!$getCustomer) {
                return response()->json(['success' => false, 'message' => 'Customer not found']);
            }
            $amount = $request->input('amount');
            $phone = $request->input('phone_number');
            $callback = $request->input('callback');
            $reference = Str::uuid();
            $description = $request->input('description') ?? "Depositing on my wallet";
            $first_name = $getCustomer->name;
            $last_name = $getCustomer->last_name;
            $email =  $getCustomer->email;
            $customer_id = $getCustomer->id;
            $cancel_url = $request->input('cancel_url');
            //add the payment reference to cancel url
            $cancel_url = $cancel_url . "?payment_reference=" . $reference;
            // return $amount;
            $data = Pesapal::orderProcess($reference, $amount, $phone, $description, $callback, $first_name, $last_name, $email, $customer_id, $cancel_url);
            return response()->json(['success' => true, 'message' => 'Order processed successfully', 'response' => $data]);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function checkTransactionStatus(Request $request)
    {

        try {
            //code...
            $request->validate([
                'orderTrackingId' => 'required|string',
                'merchantReference' => 'required|string'
            ]);
            $orderTrackingId = $request->input('orderTrackingId');
            $merchantReference = $request->input('merchantReference');
            $data = Pesapal::transactionStatus($orderTrackingId, $merchantReference);

            return response()->json(['success' => true, 'message' => 'Success', 'response' => $data->message->payment_status_description]);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }

    public function testSendingMessages(Request $request)
    {
        try {
            //code...
            $message = "Testing sending messages";
            $phoneNumber = "+256756741414";
            $res = $this->sendMessage($phoneNumber, $message);

            return response()->json(['success' => true, 'message' => 'Success', 'response' => $res]);

            return "success";
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}


