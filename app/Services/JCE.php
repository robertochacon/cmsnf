<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JCE
{
    private $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('http://172.20.16.233:7075/api/AsignarArma/Personal?nombre=m7&status=A&cedula=')
            ->withHeaders([
                'Content-Type' => 'application/json',
            ]);
    }

    public function getPerson($identification)
    {
        try {

            $response = $this->client->get(
                $identification
            )->json();

            return $response;

        } catch (GuzzleException|\Exception $e) {
            Log::error($e->getMessage());
            return ['msg' => $e->getMessage()];
        }
    }

}
