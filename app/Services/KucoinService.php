<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class KucoinService
{
    private $baseUrl;
    private $client;

    public function __construct()
    {
        $this->baseUrl = config('kucoinservice.url');
        $this->client = new Client();
    }

    private function request($endpoint)
    {
        $request = $this->client->get($this->baseUrl . '/' . $endpoint, [
            'accept' => 'application/json'
        ]);

        return json_decode($request->getBody());
    }

    public function price($currency)
    {
        return collect($this->request('prices')->data)[$currency];
    }

    public function prices()
    {
        return collect($this->request('prices')->data);
    }
}
