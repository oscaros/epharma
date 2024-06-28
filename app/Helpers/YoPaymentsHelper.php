<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class YoPaymentsHelper
{
    public static function generateSignature($data)
    {
        $stringToSign = $data['APIUsername'] .
                        $data['APIPassword'] .
                        $data['Amount'] .
                        $data['Account'] .
                        $data['Narrative'] .
                        $data['ExternalReference'] .
                        request()->ip();

        $sha1Hash = sha1($stringToSign);

        $privateKey = file_get_contents(storage_path('app/your_private_key.pem'));
        openssl_sign($sha1Hash, $signature, $privateKey, OPENSSL_ALGO_SHA1);

        return base64_encode($signature);
    }
}
