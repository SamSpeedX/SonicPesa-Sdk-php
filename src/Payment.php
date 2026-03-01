<?php

namespace SonicPesa;

use GuzzleHttp\Client;
// use SonicPesa\Exceptions\SonicPesaException;

class Payment
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create_order(array $data): array
    {
        try {
            $data = array_merge([
                "buyer_email" => "",
                "buyer_name" => "",
                "buyer_phone" => "255798313146",
                "amount" => 1000,
                "currency" => "TZS"
            ], $data);
            $response = $this->client->post('/v1/payment/create_order', [
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function order_status(string $order_id): array
    {
        try {
            $response = $this->client->post("/v1/payment/order_status", [
                'json' => ['order_id' => $order_id]
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}