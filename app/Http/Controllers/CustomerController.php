<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Entity;
use App\Models\SaleItem;
use App\Models\User;  // Make sure to import the User model
use App\Notifications\NewCustomerNotification;
use App\Traits\AuditTrait;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use AuditTrait;

    public function index()
    {
        return view('customers.index');
    }

    public function sales()
    {
        return view('customers.sales');
    }

    public function scan()
    {
        return view('customers.scan');
    }

    public function scanProcess(Request $request)
    {
        $phone = $request->input('phone');
        $customer = Customer::where('ClientID', $phone)->first();

        if ($customer) {
            return redirect()->route('sale-items.index', ['customer_id' => $customer->id]);
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }

    public function getCustomerIdByPhone(Request $request)
    {
        $phone = $request->phone;
        $customer = Customer::where('ClientID', $phone)->first();

        if ($customer) {
            return response()->json(['customerId' => $customer->id]);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    public function scanProcess2(Request $request)
    {
        $phone = $request->input('phone');
        $customer = Customer::where('ClientID', $phone)->first();

        if ($customer) {
            return response()->json(['customer' => $customer]);
        } else {
            return response()->json(['error' => 'Customer not found.'], 404);
        }
    }

    public function getPendingCustomers()
    {
        $departmentId = auth()->user()->department_id;

        $pendingCustomers = SaleItem::where('Status', 0)
            ->whereHas('product', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->with(['sale.customer', 'sale.users', 'product'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('sale.customer_id');

        return response()->json($pendingCustomers);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'FirstName' => 'required',
                'Email' => 'required',
                'Phone' => 'required',
                'LastName' => 'required',
                'PInsured' => 'required',
            ]);

            // Generate a unique ClientID
            do {
                $clientId = now()->format('Ymd') . rand(1000, 9999);
            } while (Customer::where('ClientID', $clientId)->exists());

            $data = [
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Address' => $request->Address,
                'NIN' => $request->NIN,
                'PInsured' => $request->PInsured,
                'PType' => $request->PType,
                'NewVisit' => false,  // Explicitly setting NewVisit to false
                'entity_id' => auth()->user()->entity_id,
                'ClientID' => $clientId,  // Assign the unique ClientID
            ];

            $customer = Customer::create($data);
            $customer->save();

            // Send notification to all users
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new NewCustomerNotification($customer));
            }

            $recipient = auth()->user();

            Notification::make()
                ->title('Patient admitted successfully by ' . auth()->user()->name)
                ->icon('heroicon-o-document-text')
                ->sendToDatabase($recipient)
                ->success()
                ->body('Client ' . $customer->FirstName . ' has been admitted successfully at ' . now() . ' by ' . auth()->user()->name)
                ->actions([
                    Action::make('View Client')
                        ->button()
                        ->url(route('customers.show', $customer->id), shouldOpenInNewTab: true),
                ])
                ->send();

            $this->createAudit($request, 'Created New Patient named ' . $customer->FirstName, 'Create');

            return redirect()->route('customers.index')->with('success', 'Patient created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $entity = Entity::find($customer->entity_id);
            return view('customers.show', compact('customer', 'entity'));
        } catch (\Exception $e) {
            return redirect()->route('customers.index')->with('error', 'Patient not found.');
        }
    }

    public function retrieve(Request $request)
    {
        $phone = $request->input('phone');
        $customer = Customer::where('ClientID', $phone)->first();

        if ($customer) {
            return view('customers.show', compact('customer'));
        } else {
            return redirect()->route('customers.scan')->with('error', 'Patient not found.');
        }
    }

    public function edit(string $id)
    {
        try {
            $customer = Customer::find($id);
            return view('customers.edit', compact('customer'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to edit customer =' . $th->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([]);
            $customer = Customer::find($id);

            $data = [
                'Phone' => $request->phone,
                'Address' => $request->address,
                'NIN' => $request->nin,
                'PInsured' => $request->p_insured,
                'PType' => $request->p_type,
                'Email' => $request->email,
                'UpdatedBy' => auth()->user()->id,
            ];

            $customer->update($data);
            $this->createAudit($request, "Updated Patient with ID: {$customer->id}", 'Update');
            return redirect()->route('customers.index')->with('success', 'Patient Details updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getCustomerDetails($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function destroy(string $id)
    {
        // works
    }
}
