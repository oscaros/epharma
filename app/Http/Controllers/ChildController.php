<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Mail\AccountCreation;
use App\Models\Sponsor;
use App\Models\Transaction;
use App\Models\User;
use App\Payments\Pesapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $children = Children::where('is_sponsored', false)->latest()->paginate(10);
    //     // Pass the data to the view
    //     return view('child.child', compact('children'));
    // }



    public function index(Request $request)
    {
        try {
            $children = Children::latest()->paginate(4);
            if ($request->ajax()) {
                $view = view('child.load', compact('children'))->render();
                return Response::json(['view' => $view, 'nextPageUrl' => $children->nextPageUrl()]);
            }
            return view('child.child', compact('children'));
        } catch (\Exception $e) {
            // Handle the exception here
            // You can log the error, return a specific response, etc.
            // For example:
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function ajaxChildren(Request $request)
    {
        // Get the page number from the AJAX request, default to 1 if not provided
        $page = $request->input('page', 1);

        // Fetch the children records for the specified page
        $children = Children::where('is_sponsored', false)->latest()->paginate(10, ['*'], 'page', $page);

        // Render the view for the paginated children records
        $view = view('child.ajax_children', compact('children'))->render();

        // Return the HTML content of the paginated children records
        return response()->json(['html' => $view]);
    }

    public function sponsorMore(Request $request)
    {
        try {
            $numberOfChildren = $request->input('children');
            $gender = $request->input('gender');
            $ageRange = $request->input('age_range');

            // Query children based on selected criteria
            $childrenQuery = Children::orderBy('created_at', 'desc')
                ->where('is_sponsored', false)
                ->whereBetween('date_of_birth', $this->getAgeRange($ageRange));

            // Filter children based on gender
            if ($gender !== 'any') {
                $childrenQuery->whereJsonContains('gender', $gender);
            }

            // Limit the number of children
            $children = $childrenQuery->limit($numberOfChildren)->get();

            // Process the fetched children data as needed

            return response()->json(['response' => 'success', 'data' => $children], 200);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'failed', 'message' => $th->getMessage()], 500);
        }
    }


    private function getAgeRange($ageRange)
    {
        // Get current date
        $currentDate = date('Y-m-d');

        switch ($ageRange) {
            case '1':
                // Calculate start and end dates for age range 4-10 years
                $startAge = date('Y-m-d', strtotime('-10 years', strtotime($currentDate)));
                $endAge = date('Y-m-d', strtotime('-3 years', strtotime($currentDate)));
                break;
            case '2':
                // Calculate start and end dates for age range 11-16 years
                $startAge = date('Y-m-d', strtotime('-16 years', strtotime($currentDate)));
                $endAge = date('Y-m-d', strtotime('-11 years', strtotime($currentDate)));
                break;
            case '3':
                // Calculate start and end dates for age range 16-21 years
                $startAge = date('Y-m-d', strtotime('-21 years', strtotime($currentDate)));
                $endAge = date('Y-m-d', strtotime('-17 years', strtotime($currentDate)));
                break;
            default:
                // Default range if age range is not specified
                $startAge = '1900-01-01'; // Adjust as needed
                $endAge = $currentDate; // Current date
                break;
        }

        return [$startAge, $endAge];
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
        try {
            $validatedData = [];
            $is_individual = $request->input('is_individual');

            if ($is_individual == "is_individual") {
                $validatedData = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'phone_number' => 'required|string|max:255',
                    'country' => 'required|string|max:255',
                ]);
            } else {
                $validatedData = $request->validate([
                    'organization_name' => 'required|string|max:255',
                    'organization_type' => 'required|string|max:255',
                    'primary_contact_first_name' => 'required|string|max:255',
                    'primary_contact_last_name' => 'required|string|max:255',
                    'primary_contact_email' => 'required|email|max:255',
                    'primary_contact_phone' => 'required|string|max:255',
                ]);
            }

            $sponsorData = [
                'first_name' => $is_individual == "is_individual" ? $request->input('first_name') : $request->input('primary_contact_first_name'),
                'last_name' => $is_individual == "is_individual" ? $request->input('last_name') : $request->input('primary_contact_last_name'),
                'phone_number' => $is_individual == "is_individual" ? $request->input('phone_number') : $request->input('primary_contact_phone'),
                'address' => $request->input('address', null),
                'city' => $request->input('city', null),
                'state' => $request->input('state', null),
                'country' => $request->input('country', null),
                'postal_code' => $request->input('postal_code', null),
                'sponsor_identifier' => Str::random(10),
                'type' => $is_individual == "is_individual" ? "individual" : "organization",
                'organization_name' => $request->input('organization_name', null),
                'organization_type' => $request->input('organization_type', null),
            ];
            // dd($sponsorData);

            // Check if the sponsor with the provided email already exists
            $sponsor = Sponsor::where('email', $request->input('email'))->first();
            if (!$sponsor) {
                $sponsor = Sponsor::create($sponsorData);
            }

            // Check if the user with the provided email already exists
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                $password = Str::random(8);
                $user = User::create([
                    'email' => $request->input('email'),
                    'name' => $sponsorData['first_name'] . ' ' . $sponsorData['last_name'],
                    'password' => $password
                ]);

                Mail::to($request->input('email'))->send(new AccountCreation($sponsorData['first_name'], $password));
            } else {
            }

            $more_children =  $request->child_ids;
            $amount = 500;
            $total_amount = $amount;
            $child_ids = null;
            $status = config("status.payment_status.pending");
            $customer_email = $request->input('email');
            $customer_id = $sponsor->id;
            $phone_number = $is_individual == "is_individual" ? $request->input('phone_number') : $request->input('primary_contact_phone');
            $reference = Str::uuid();

            $description = "Payment for  child sponsorhip";


            if (empty($more_children)) {
                // dd("empty");
            } else {
                $ids = $more_children[0]; // Assuming $array is your array with the IDs
                $extractedIds = explode(',', $ids);
                $child_ids = $extractedIds;
                $total_amount += 500 * count($extractedIds);
            }


            Transaction::create([
                'reference' => $reference,
                'amount' => $amount,
                'sponsor_id' => $sponsor->id,
                'status' => $status,
                'description' => $description,
                'phone_number' => $phone_number,
                'payment_mode' => "pesapal",
                'OrderNotificationType' => "pesapal",
                'order_tracking_id' => $reference,
                'type' => "SponsorChild",
                'payment_method' => "Pesapal",
                'user_id' => $user->id,
                'child_id' => $request->child_id,
                'child_ids' => json_encode($child_ids)
            ]);



            $callback_url = "https://dummy.fountainofpeace.org.ug/finishPayment";
            $cancel_url = "https://dummy.fountainofpeace.org.ug/cancelPayment";

            $res = Pesapal::orderProcess($reference, $total_amount, $phone_number, $description, $callback_url, $sponsorData['first_name'], $sponsorData['last_name'], $customer_email, $customer_id, $cancel_url);
          
            if ($res->success) {
                return redirect($res->message->redirect_url);
            } else {
                return redirect()->back()->with('error', 'Payment Failed please try again');
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $child = Children::findOrFail($id);
        return view('contact', ['child' => $child]);
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

    //
}
