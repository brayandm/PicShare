<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class WeatherService
{
    private $secret;
    private $baseUrl;
    private $client;

    public function __construct()
    {
        $this->secret = config('weatherservice.secret');
        $this->baseUrl = config('weatherservice.url');
        $this->client = new Client();
    }

    private function request($endpoint, $query)
    {
        $request = $this->client->get($this->baseUrl . '/' . $endpoint . '.json', [
            RequestOptions::QUERY => [
                'key' => $this->secret,
                'q' => $query,
            ],
            'accept' => 'application/json'
        ]);

        return json_decode($request->getBody());
    }

    public function temperature($query)
    {
        return $this->request('current', $query)->current->temp_c;
    }

    public function condition($query)
    {
        $result = $this->request('current', $query);

        return ['text' => $result->current->condition->text, 'icon' => 'https:' . $result->current->condition->icon];
    }
}
