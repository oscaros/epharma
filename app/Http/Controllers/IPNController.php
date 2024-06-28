<?php

namespace App\Http\Controllers;

use App\Models\IPNTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IPNController extends Controller
{
    //

    // public function handleIPN(Request $request)
    // {
    //     // Log the IPN request
    //     Log::info('IPN Request:', $request->all());

    //     // Validate and verify the signature
    //     $signature = $request->input('signature');
    //     $data = $request->input('date_time') .
    //             $request->input('amount') .
    //             $request->input('narrative') .
    //             $request->input('network_ref') .
    //             $request->input('external_ref') .
    //             $request->input('msisdn');

    //     if (!$this->verifySignature($data, $signature)) {
    //         return response('Invalid signature', 400);
    //     }

    //     // Prevent duplicate transactions
    //     if (IPNTransaction::where('network_ref', $request->input('network_ref'))->exists()) {
    //         return response('Duplicate transaction', 200);
    //     }

    //     // Save the transaction
    //     IPNTransaction::create($request->all());

    //     // Respond with 200 OK
    //     return response('OK', 200);
    // }

    // private function verifySignature($data, $signature)
    // {
    //     $publicKey = file_get_contents(storage_path('app/your_public_key.pem'));
    //     $decodedSignature = base64_decode($signature);

    //     return openssl_verify($data, $decodedSignature, $publicKey, OPENSSL_ALGO_SHA1) === 1;
    // }




    public function handleIPN(Request $request)
    {
        $data = $request->all();
        
        // Log the incoming IPN request
        Log::info('IPN Request: ', $data);

        // Step 1: Acknowledge the IPN request with a 200 OK response
        http_response_code(200);

        // Step 2: Verify the signature
        if (!$this->verifySignature($data)) {
            Log::error('IPN Signature Verification Failed');
            return response('Invalid Signature', 400);
        }

        // Step 3: Check for duplicate transactions
        if ($this->isDuplicateTransaction($data['network_ref'], $data['msisdn'])) {
            Log::warning('Duplicate IPN Message Detected');
            return response('Duplicate IPN', 200);
        }

        // Step 4: Process the transaction
        $this->processTransaction($data);

        // Optional: Trigger SMS if needed
        if (isset($data['narrative']) && $data['narrative'] === 'trigger_sms') {
            return response()->json([
                'narrative' => 'Dear John, we have received your payment of UGX2,500 (ref: 71299191). Thank you for your business.'
            ]);
        }

        return response('IPN Handled', 200);
    }

    private function verifySignature($data)
    {
        // Get the public key from your settings
        $publicKey = file_get_contents(storage_path('app/public_key.pem'));

        // Recreate the signature string
        $signatureString = $data['date_time'] . $data['amount'] . $data['narrative'] . $data['network_ref'] . $data['external_ref'] . $data['msisdn'];

        // Decode the received signature
        $signature = base64_decode($data['signature']);

        // Verify the signature using the public key
        return openssl_verify($signatureString, $signature, $publicKey, OPENSSL_ALGO_SHA1);
    }

    private function isDuplicateTransaction($networkRef, $msisdn)
    {
        // Implement logic to check for duplicates in your database
        return false;
    }

    private function processTransaction($data)
{
    // Store the transaction in the database
    $ipn_transaction = IPNTransaction::create([
        'network_ref' => $data['network_ref'],
        'msisdn' => $data['msisdn'],
        'amount' => $data['amount'],
        'narrative' => $data['narrative'],
        'payer_names' => $data['payer_names'],
        'payer_email' => $data['payer_email'],
    ]);

    dd($ipn_transaction);

    // Update your sales table or any other related tables as needed
}

}
