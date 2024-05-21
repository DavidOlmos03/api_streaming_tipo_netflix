<?php

namespace App\Http\Controllers\Admin\Helper;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;

class PaypalSubcription {

    public $client;
    public $AccessToken;
    public $URL_BASE;

    public function __construct() {

        $clientId = env("PAYPAL_CLIENT_ID");
        $secret = env("PAYPAL_SECRET");

        $this->URL_BASE = 'https://api-m.sandbox.paypal.com/v1/';
        $this->client = new GuzzleClient(["base_uri" => $this->URL_BASE]);
        $this->AccessToken = $this->getAccessToken($clientId,$secret);
    }

    private function getAccessToken($clientId,$secret){

        $response = $this->client->request('POST', 'oauth2/token', [
            "headers" => [
                "Accept" => "application/json",
                "Content-Type" => "application/x-www-form-urlencoded"
            ],
            "body" => "grant_type=client_credentials",
            "auth" => [
                $clientId, $secret, 'basic'
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        return $response["access_token"];
    }

    // DEFINIR TODAS LAS DEMAS RUTAS

    public function getProducts() {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products");
        return json_decode($response->getBody(), true);
    }

    public function storeProducts($data) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->post($this->URL_BASE."catalogs/products",$data);
        return json_decode($response->getBody(), true);
    }

    public function updateProducts($product_id,$data) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->patch($this->URL_BASE."catalogs/products/".$product_id,$data);
        return json_decode($response->getBody(), true);
    }

    public function showProduct($product_id) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products/".$product_id);
        return json_decode($response->getBody(), true);
    }
}
