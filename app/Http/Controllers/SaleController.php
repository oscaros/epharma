<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Payments\Pesapal;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $grandTotal = 0;

    public $cart = [];

    public function index()
    {
        //
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateGrandTotal()
    {
        $this->grandTotal = collect($this->cart)->sum();
    }

    public function updateReceipt()
    {
        $customers = Customer::all();

        return view(
            'livewire.list-sale-products',
            compact('customers'),
            [
                'grandTotal' => $this->grandTotal,
            ]
        );
    }

    public function create()
    {
        // Get today's date in the format used by your database
        $today = now()->toDateString();
    
        // Check user role and filter customers accordingly
        if (auth()->user()->role_id == 1) {
            $customers = Customer::whereDate('updated_at', $today)
                                 ->orderBy('updated_at', 'desc')
                                 ->get();
        } else {
            $customers = Customer::query()
                                 ->where('entity_id', auth()->user()->entity_id)
                                 ->whereDate('updated_at', $today)
                                 ->get();
        }
    
        $selectedCustomerId = null;  // Default value when no customer is selected
        
        // Pass the filtered customers and grandTotal to the view
        return view('sales.create', compact('customers', 'selectedCustomerId'))
               ->with('grandTotal', $this->grandTotal);
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
            $productIds = json_decode($request->productIds);
            $quantities = json_decode($request->productQuantities);
            // $productNames = explode(',', $request->productNames);
            // $productPrices = explode(',', $request->productPrices);

            // Ensure $productIds and $quantities are arrays
            if (!is_array($productIds) || !is_array($quantities)) {
                throw new \Exception('Invalid product data provided.');
            }

            // Save the sale to the database
            // foreach ($productIds as $key => $productId) {

            $amount = $grandTotal;

            $status = config('status.payment_status.pending');

            $customer_name = $request->input('customer_name');
            $cashier = User::find(auth()->id());
            $phone_number =  $request->input('phone_number');
            $phone_number = preg_replace('/^0/','256',$phone_number);
            // $phone_number = '0756741414';
            // $amount = '5000';
            $reference = Str::uuid();
            // $customer_id = $request->input('customer_id');
            $customer_id = $request->customer_id;
            // $customer_id = 1;

            $description = 'Payment of ' . $grandTotal . ' for reference number: ' . $reference;

            // $sale =
            $sale = Sale::create([
                'product_id' => json_encode($productIds),
                'quantities' => json_encode($quantities),
                'amount' => $amount,
                'user_id' => auth()->id(),
                'entity_id' => auth()->user()->entity_id,
                'reference' => $reference,
                'status' => $status,
                'description' => $description,
                'phone_number' => $phone_number,
                'payment_mode' => 'Yo Pay',
                'OrderNotificationType' => 'SMS',
                'order_tracking_id' => $reference,
                'type' => 'Wholesale',
                'payment_method' => 'Yo Pay',
                'customer_id' => $customer_id,
               
            ]);

            // dd($customer_id);

            // dd($sale);

            $recipient = auth()->user();

        
                


                Notification::make()

                ->title('Selection successfull')
                ->sendToDatabase($recipient)
                ->success()
                ->body('Items selctions confirmed succesfully.')
                ->actions([
                    Action::make('markAsUnread')
                        ->button()
                        ->markAsUnread(),
                ])
                ->send();

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

            $res = Pesapal::orderProcess($reference, $amount, $phone_number, $description, $callback_url, $cashier->name, $cashier->email, $cashier->id, $cancel_url);
            // dd($res);
            // dd($res->success);
            // dd($res->message->redirect_url);
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
