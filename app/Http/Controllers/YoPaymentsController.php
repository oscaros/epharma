<?php

namespace App\Http\Controllers;

use App\Payments\YoAPI;
use Illuminate\Http\Request;

class YoPayments extends Controller
{
    // public function makePayment(Request $request)
    // {
    //     try {
         
    //         $username = '1780457';
    //         $password = 's3tQ-H9uF-vofe-6WvB-9NfY-fu4q-3wrQ-leYv';
    //         $externalReference = time();

    //         $YoPayments = new YoAPI($username, $password);
    //         $YoPayments->set_instant_notification_url('https://webhook.site/396126eb-cc9b-4c57-a7a9-58f43d2b7935');
    //         $YoPayments->set_external_reference($externalReference);

    //         $amount = 1000;
    //         $msisdn = '256756741414';
    //         $narrative = 'Success Payment';

    //         $res = $YoPayments->ac_deposit_funds($amount, $msisdn, $narrative);

    //         return response()->json($res);
    //     } catch (Exception $e) {
      
    //         return response()->json($e->getMessage());
    //     }
    // }

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
