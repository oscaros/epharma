<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // Add this line

class QRCodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index');
    }

    public function read(Request $request)
    {
        dd($request->all());
        $message = $request->input('message');

        dd($message);

        Log::info('Received QR code message: ' . $message);

        return view('qrcode.result', ['message' => $message]);
    }

    public function scanQR()
    {
        // Logic to interact with the 2D barcode reader would go here
        // This will depend on the specific reader you're using and how it interfaces with the PC

        // For demonstration, let's assume you have the QR code data as a string
        $qrData = 'Sample QR Code Data';

        // Return a view with the QR data
        return view('scan-qr', compact('qrData'));
    }
}
