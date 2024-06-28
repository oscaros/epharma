<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YoPaymentsService
{
    protected $apiUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->apiUrl = env('YO_PAYMENTS_URL');
        $this->username = env('YO_PAYMENTS_USERNAME');
        $this->password = env('YO_PAYMENTS_PASSWORD');
    }

    public function depositFunds($data)
    {
        $xmlRequest = $this->buildXmlRequest($data);

        $response = Http::withHeaders([
            'Content-Type' => 'text/xml',
        ])->post($this->apiUrl, $xmlRequest);

        return $this->parseXmlResponse($response->body());
    }

    protected function buildXmlRequest($data)
    {
        $xml = new \SimpleXMLElement('<AutoCreate><Request></Request></AutoCreate>');
        $request = $xml->Request;

        $request->addChild('APIUsername', $this->username);
        $request->addChild('APIPassword', $this->password);
        $request->addChild('Method', 'acdepositfunds');
        $request->addChild('NonBlocking', $data['non_blocking']);
        $request->addChild('Amount', $data['amount']);
        $request->addChild('Account', $data['account']);
        $request->addChild('AccountProviderCode', $data['account_provider_code']);
        $request->addChild('Narrative', $data['narrative']);
        // $request->addChild('InternalReference', $data['internal_reference']);
        // $request->addChild('ExternalReference', $data['external_reference']);
        // $request->addChild('ProviderReferenceText', $data['provider_reference_text']);
        $request->addChild('InstantNotificationUrl', $data['instant_notification_url']);
        $request->addChild('FailureNotificationUrl', $data['failure_notification_url']);

        return $xml->asXML();
    }

    protected function parseXmlResponse($response)
    {
        $xml = simplexml_load_string($response);
        return json_decode(json_encode($xml), true);
    }
}
