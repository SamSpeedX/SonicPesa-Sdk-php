<?php

namespace SonicPesa;

use GuzzleHttp\Client;
use SonicPesa\Exceptions\SonicPesaException;
use SonicPesa\Payment;

class SonicPesa
{
    protected string $apiKey;
    protected string $secreteKey;
    protected string $baseUrl;
    protected Client $client;

    public function __construct(string $apiKey, string $secreteKey, string $baseUrl = "https://api.sonicpesa.com/api")
    {
        $this->apiKey = $apiKey;
        $this->secreteKey = $secreteKey;
        $this->baseUrl = $baseUrl;

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'X-SECRET-KEY' => $this->secreteKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function payment(): Payment
    {
        return new Payment($this->client);
    }
}