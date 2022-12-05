<?php
namespace App\Helpers;
use GuzzleHttp\Client as GuzzleHttpClient;

class HttpClient {
    public static function get($url)
    {
        $client = new GuzzleHttpClient();
        $response = $client->get($url);
        return json_decode($response->getBody()->getContents(),true);
    }
    public static function post($url,$body) {
        $client = new GuzzleHttpClient();
        $response = $client->request("POST",$url, ['query' => $body]);
        return json_decode($response->getBody()->getContents(),true);
    }
}