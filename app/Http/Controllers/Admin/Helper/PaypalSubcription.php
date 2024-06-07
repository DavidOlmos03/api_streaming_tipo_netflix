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



                                 // SECCIÓN DE PRODUCTOS
    // Función para obtener los productos
    public function getProducts() {
        // Se realiza la solicitud http, en la variable $response se almacenará la respuesta de la solicitud
        // mediante withHeaders se especifican los encabezados de la solicitud
        $response = Http::withHeaders([
            // Se espera una respuesta en formato json
            "Accept" => "application/json",
            // El contenido de la solicitud se enviara en formato json
            "Content-Type" => "application/json",
            // Se añade un encabezado de autorización que incluye un token de acceso (Bearer token) es un token dinamico que se obtiene con
            // $this->AccessToken
            "Authorization" => "Bearer ".$this->AccessToken,
            // Se hace la solicitud get con la base URL_BASE y concatenando el endPoint catalogs/products, este endPoint se obtiene
            // de la API de paypal https://developer.paypal.com/docs/api/catalog-products/v1/#products_create
        ])->get($this->URL_BASE."catalogs/products");
        return json_decode($response->getBody(), true);
    }

    // Metodo para insertar datos en products   !!!!!!!!!!REVISAR
    public function storeProducts($data) {
        // Se realiza la solicitud http
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->post($this->URL_BASE."catalogs/products",$data);
        return json_decode($response->getBody(), true);
    }

    // Metodo para actualizar datos de un producto, mediante su id
    public function updateProducts($product_id,$data) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->patch($this->URL_BASE."catalogs/products/".$product_id,$data);
        return json_decode($response->getBody(), true);
    }

    // Se obtienen todos los datos de un producto en específico
    public function showProduct($product_id) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->get($this->URL_BASE."catalogs/products/".$product_id);
        return json_decode($response->getBody(), true);
    }

                                    // SECCIÓN DE PLANES

    // Se obtienen todos los planes
    public function getPlanes() {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
            // El end point se obtiene de https://developer.paypal.com/docs/api/subscriptions/v1/#plans_create en cURL
        ])->get($this->URL_BASE."billing/plans");
        return json_decode($response->getBody(), true);
    }
    // Para insertar planes
    public function storePlanes($plan) {
        $data = [
            // Estos datos son de paypal
            'product_id' => $plan["product_id"],
            'name' => $plan["name"],
            'description' => $plan["description"],
            'status' => 'ACTIVE',
            'billing_cycles' => $plan["billing_cycles"],
            //     [
            //         'frequency' => [
            //             'interval_unit' => 'MONTH',
            //             'interval_count' => '1'
            //         ],
            //         'tenure_type' => 'REGULAR',
            //         'sequence' => '1',
            //         'total_cycles' => '12',
            //         'pricing_scheme' => [
            //             'fixed_price' => [
            //                 'value' => '3',
            //                 'currency_code' => 'USD'
            //             ]
            //         ]
            //     ]
            // ],
            'payment_preferences' => [
                'auto_bill_outstanding' => 'true',
                'setup_fee' => [
                    // valor por defecto para el pago, se pone dirente a cero cuando se debe hacer un pago inicial si o si
                    'value' => '0',
                    'currency_code' => 'USD'
                ],
                'setup_fee_failure_action' => 'CONTINUE',
                'payment_failure_threshold' => '3'
            ],
            'taxes' => [
                'percentage' => '10',
                'inclusive' => false
            ]
        ];

        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->post($this->URL_BASE."billing/plans",$data);
        return json_decode($response->getBody(), true);
    }

    // Para la actualización de un plan en especifico
    public function updatePlanes($plan_id,$data) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->patch($this->URL_BASE."billing/plans/".$plan_id,$data);
        return json_decode($response->getBody(), true);
    }

    // Para listar los datos de un plan, mediante su id
    public function showPlane($plan_id) {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer ".$this->AccessToken,
        ])->get($this->URL_BASE."billing/plans/".$plan_id);
        return json_decode($response->getBody(), true);
    }
}
