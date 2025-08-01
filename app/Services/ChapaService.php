<?php

namespace App\Services;

use GuzzleHttp\Client;

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

}
