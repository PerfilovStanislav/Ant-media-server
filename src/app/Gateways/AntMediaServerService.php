<?php

namespace App\Gateways;

use Illuminate\Support\Facades\Http;

class AntMediaServerService
{
    public const URL = 'http://ams:5080/WebRTCApp/rest/v2/';

    public function createBroadcast(string $hashId, string $name): array
    {
        $params = [
            'streamId'  => $hashId,
            'name'      => $name,
        ];

        $response = Http::post(self::URL . 'broadcasts/create', $params);
        $response->throw();

        return $response->json();
    }

    public function getStream(string $hashId): array
    {
        $response = Http::get(self::URL . "broadcasts/$hashId");
        $response->throw();

        return $response->json();
    }
}
