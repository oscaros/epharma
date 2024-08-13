<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\ProductTemp;
use App\Traits\AuditTrait;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    use AuditTrait;

    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role_id == 1) {
            // If the user has a role of 1, return all departments
            $departments = Department::all();
        } else {
            // Otherwise, return departments where the entity_id matches the user's entity_id
            $departments = Department::where('entity_id', $user->entity_id)->get();
        }

        return view('products.create', compact('departments'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'ProductName' => 'required|string',
                // 'Price' => 'required|numeric',
                'raw_price' => 'required|numeric',  // Validate raw_price as numeric
                'Quantity' => 'nullable|integer',
                'Insured' => 'nullable|boolean',
                'departments' => 'required|array|exists:departments,id',
                'BrandNames' => 'nullable|string',
                'DrugClass' => 'nullable|string',
                'expiry_date' => 'nullable|date',
            ]);

            $productData = $request->only([
                'ProductName',
                // 'Price',
                'raw_price',  // Use raw_price
                'Quantity',
                'Insured',
                'BrandNames',
                'DrugClass',
                'expiry_date'
            ]);
            $productData['serial_number'] = mt_rand(10000000, 99999999);  // Generate serial number
            $productData['entity_id'] = auth()->user()->entity_id;
            $productData['Price'] = $productData['raw_price'];  // Assign raw_price to Price
            unset($productData['raw_price']);  // Remove raw_price

            $product = Product::create($productData);
            $product->departments()->attach($request->departments);

            $recipient = auth()->user();

            // Notification::make()
            //     ->title('Item'. $product->ProductName . ' added successfully')
            //     ->sendToDatabase($recipient);

            Notification::make()
                ->title('Item' . $product->ProductName . ' added successfully')
                ->sendToDatabase($recipient)
                ->success()
                ->body('Item addition has been succesfull.')
                ->actions([
                    Action::make('markAsUnread')
                        ->button()
                        ->markAsUnread(),
                ])
                ->send();

            $this->createAudit($request, 'Created Drug/Service with name - ' . $product->ProductName, 'CREATE');
            return redirect()->route('products.index')->with('success', 'Item added successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $departments = Department::all();
            return view('products.show', compact('product', 'departments'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $departments = Department::all();
        return view('products.edit', compact('product', 'departments'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'ProductName' => 'required|string',
                'raw_price' => 'required|numeric',  // Validate raw_price as numeric
                'Insured' => 'nullable|boolean',
                'departments' => 'required|array|exists:departments,id',
                'BrandNames' => 'nullable|string',
                'DrugClass' => 'nullable|string',
                'expiry_date' => 'nullable|date',
            ]);

            $product = Product::findOrFail($id);
            $productData = $request->only([
                'ProductName',
                'raw_price',  // Use raw_price
                'Insured',
                'BrandNames',
                'DrugClass',
                'expiry_date'
            ]);
            $productData['entity_id'] = auth()->user()->entity_id;
            $productData['Price'] = $productData['raw_price'];  // Assign raw_price to Price
            unset($productData['raw_price']);  // Remove raw_price

            $product->update($productData);
            $product->departments()->sync($request->departments);

            $data = [
                'ProductName' => $product->ProductName,
                'Price' => $product->Price,
                'Quantity' => $product->Quantity,
                'serial_number' => $product->serial_number,
                'entity_id' => auth()->user()->entity_id,
                'AddedBy' => auth()->id(),
                'AddedOn' => Carbon::now(),
                'ApprovedBy' => auth()->id(),
                'ApprovedOn' => Carbon::now(),
                'status' => '0',
            ];

            ProductTemp::updateOrCreate(['id' => $product->id], $data);

            $this->createAudit($request, "Updated Product: {$product->ProductName}", 'UPDATE');
            return redirect()->route('products.index')->with('success', 'Item updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function productData($id)
    {
        Log::info("Attempting to fetch item with ID: {$id}");
        try {
            $product = Product::findOrFail($id);
            Log::info('Item found: ' . json_encode($product));
            return response()->json($product);
        } catch (\Exception $e) {
            Log::error("Failed to fetch product with ID: {$id} - " . $e->getMessage());
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function destroy($id)
    {
        // Implement delete functionality if required
    }
}
