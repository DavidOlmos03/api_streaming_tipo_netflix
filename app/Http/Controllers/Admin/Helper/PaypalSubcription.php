<?php

namespace App\Http\Controllers\Admin\Helper;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Http;

class PaypalSubcription {
    public $client;
    public $AccessToken;
    public $URL_BASE;


    // Cada vez que acceda a esta clase se obtendra un accessToken para con esto hacer mis solicitudes
    public function __construct(){
        $clientId = env("PAYPAL_CLIENT_ID");
        $secret = env("PAYPAL_SECRET");

        $this->URL_BASE = 'https://api-m.sandbox.paypal.com/v1/';
        $this->client = new GuzzleClient(["base_uri"=>$this->URL_BASE]);
        $this->AccessToken = $this->getAccessToken($clientId,$secret);
    }

    function getAccessToken($clientId,$secret){
        $response = $this->client->request('POST','oauth2/token',[
            "headers"=>[
                "Accept"=>"application/json",
                "Content-Type"=>"application/x-www-form-urlencoded"
            ],
            "body"=>"grant_type=client_credentials",
            "auth"=>[
                $clientId,$secret,'basic'
            ]
            ]);

            $response = json_decode($response->getBody(),true);
            return $response["access_token"];
    }


    //DEFINIR TODAS LAS DEMAS RUTAS

    public function getProducts(){
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Content-Type"=>"application/x-www-form-urlencoded",
            "Authorization" => "Bearer".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products");  //Esta es la parte donde consumimos la API de PayPal

        return json_decode($response->getBody(),true);
    }
    // Para guardar un producto
    public function storeProducts($data){
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Content-Type"=>"application/x-www-form-urlencoded",
            "Authorization" => "Bearer".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products",$data);  //Esta es la parte donde consumimos la API de PayPal

        return json_decode($response->getBody(),true);
    }
    // Para actualizar un producto
    public function updateProducts($product_id,$data){
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Content-Type"=>"application/x-www-form-urlencoded",
            "Authorization" => "Bearer".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products".$product_id,$data);  //Esta es la parte donde consumimos la API de PayPal

        return json_decode($response->getBody(),true);
    }

    // Para ver detalles del producto
    public function showProduct(){
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Content-Type"=>"application/x-www-form-urlencoded",
            "Authorization" => "Bearer".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products");  //Esta es la parte donde consumimos la API de PayPal

        return json_decode($response->getBody(),true);
    }


}
