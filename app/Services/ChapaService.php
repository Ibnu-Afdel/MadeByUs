<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;

use function Pest\Laravel\json;

class ChapaService
{
    protected Client $client;
    protected string $baseUrl;
    protected string $secretKey;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->baseUrl = config('chapa.base_url');
        $this->secretKey = config('chapa.secret_key');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function initializePayment($data)
    {
        // $txRef = Str::uuid()->toString(); -> will pass from controller ..

        $payload  = array_merge($data, [
            // 'tx_ref' => $txRef,
            'currency' => 'ETB',
            // 'callback_url' => config('chapa.callback_url'),
            // 'return_url' => config('app.url') . '/pro/thank-you',
        ]);
        try {
            $response = $this->client->post('/v1/transaction/initialize', [
                'json' => $payload
            ]);
            $result = json_decode($response->getBody()->getContents(), true);

            if (($result['status'] ?? '') === 'success'){
                return $result['data']['checkout_url'];
            }
            throw new \Exception($result['message'] ?? 'Failed to initialize Chapa payment');
        } catch(RequestException $e){
            throw new \Exception('Chapa result failed.');
        }
    }

    public function verifyTransaction($txRef)
    {
        try{
            $response = $this->client->get("/v1/transaction/verify/{$txRef}");
            $body = json_decode($response->getBody(), true);
            return $body;
        } catch(\Exception $e){
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
