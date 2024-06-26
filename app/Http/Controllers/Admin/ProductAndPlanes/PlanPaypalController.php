<?php

namespace App\Http\Controllers\Admin\ProductAndPlanes;
use App\Http\Controllers\Admin\Helper\PaypalSubcription;
use App\Http\Controllers\Controller;
use App\Models\Plan\PlanPaypal;
// Se importa la clase Request del namespace Illuminate\Http. La clase Request de Laravel encapsula la información de una solicitud HTTP
// y proporciona métodos convenientes para acceder a los datos de la solicitud, como parámetros de entrada, encabezados, archivos cargados, etc.
use Illuminate\Http\Request;

class PlanPaypalController extends Controller
{
    public $paypalSubscription;
    public function __construct(PaypalSubcription $paypalSubscription) {
        $this->paypalSubscription = $paypalSubscription;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Esto accede a un parámetro de entrada llamado search de la solicitud HTTP.
        $search = $request->search;
        // Para hacer las consultas a la base de datos de paypal desde postman
        // dd($this->paypalSubscription->getPlanes());
        $plans = PlanPaypal::where("name","like","%".$search."%")->orderBy("id","desc")->get();

        return response()->json(["plans"=>$plans->map(function($plan){
            return [
                "id" => $plan->id,
                "name" => $plan-> name,
                "product" => $plan-> product_paypal,
                "description" => $plan-> description,
                "precio_mensual" => $plan-> precio_mensual,
                "precio_anual" => $plan-> precio_anual,
                "month_free" => $plan-> month_free,
                "id_plan_paypal_mensual" => $plan-> id_plan_paypal_mensual,
                "id_plan_paypal_anual" => $plan-> id_plan_paypal_anual,
                "id_product_paypal" => $plan-> id_product_paypal,
                "product_paypal_id" => $plan -> product_paypal_id,
                "created_at" => $plan->created_at->format("Y-m-d h:i:s")
            ];
        })]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                                // PARA PLAN MENSUAL

        $plan_mensual = [];
        $plan_mensual["product_id"] = $request->id_product_paypal;
        $plan_mensual["name"] =  $request->name . " - MENSUAL";
        $plan_mensual["description"] = $request->description." - MENSUAL";
        $plan_mensual["billing_cycles"] = [];
        // En month_free es la cantidad de meses de prueba
        // Creación mes gratis en plan mensual
        if($request -> month_free > 0){
            array_push($plan_mensual["billing_cycles"],
                // Periodo gratuito en el plan de subscripción definido por tenure_type y total_cicles
                [
                    'frequency' => [
                        'interval_unit' => 'MONTH',
                        // interval_count es cada cuantos meses voy a realizar el cobro
                        'interval_count' => '1'
                    ],
                    'tenure_type' => 'TRIAL',
                    'sequence' => '1',
                    'total_cycles' => $request -> month_free,
                    'pricing_scheme' => [
                        'fixed_price' => [
                            'value' => '0',
                            'currency_code' => 'USD'
                        ]
                    ]
                ]
            );

        };
        // Creación plan mensual
        array_push($plan_mensual["billing_cycles"],
        [
            'frequency' => [
                'interval_unit' => 'MONTH',
                // interval_count es cada cuantos meses voy a realizar el cobro
                'interval_count' => '1'
            ],
            'tenure_type' => 'REGULAR',
            'sequence' => $request -> month_free > 0 ? '2' : '1',
            'total_cycles' => '12',
            'pricing_scheme' => [
                'fixed_price' => [
                    'value' => $request->precio_mensual,
                    'currency_code' => 'USD'
                ]
            ]
        ]
        );
        // Se realiza la subscripción mensual
        $response_MENSUAL = $this->paypalSubscription->storePlanes($plan_mensual);

                                // PARA PLAN ANUAL

        //  VIMEO -> 20 USD -> 12USD*12 = 144 USD para que sea mas economico que pagar los 20 USD mensual
        $plan_anual = [];
        $plan_anual["product_id"] = $request -> id_product_paypal;
        $plan_anual["name"] =  $request->name . " - ANUAL";
        $plan_anual["description"] = $request->description." - ANUAL";
        $plan_anual["billing_cycles"] = [];
        // Creación mes gratis plan anual
        if($request -> month_free > 0){
            array_push( $plan_anual["billing_cycles"],
                // Periodo gratuito en el plan de subscripción definido por tenure_type y total_cicles
                [
                    'frequency' => [
                        'interval_unit' => 'MONTH',
                        // interval_count es cada cuantos meses voy a realizar el cobro
                        'interval_count' => '1'
                    ],
                    'tenure_type' => 'TRIAL',
                    'sequence' => '1',
                    'total_cycles' => $request -> month_free,
                    'pricing_scheme' => [
                        'fixed_price' => [
                            'value' => '0',
                            'currency_code' => 'USD'
                        ]
                    ]
                ],
            );
        };
        // Creación plan anual
        array_push($plan_anual["billing_cycles"],
            [
                'frequency' => [
                    'interval_unit' => 'YEAR',
                    'interval_count' => '1'
                ],
                'tenure_type' => 'REGULAR',
                'sequence' => $request -> month_free > 0 ? '2' : '1',
                'total_cycles' => '12',
                'pricing_scheme' => [
                    'fixed_price' => [
                        'value' => $request->precio_anual,
                        'currency_code' => 'USD'
                    ]
                ]
            ]
        );
        // Se realiza la subscripción anual
        $response_ANUAL = $this->paypalSubscription->storePlanes($plan_anual);

        $request->request->add([
            "id_plan_paypal_mensual" => $response_MENSUAL["id"],
            "id_plan_paypal_anual" => $response_ANUAL["id"]
        ]);


        $planPaypal = PlanPaypal::create($request -> all());

        return response()->json(["plan"=>
            [
                "id" => $planPaypal->id,
                "name" => $planPaypal-> name,
                "product" => $planPaypal-> product_paypal,
                "description" => $planPaypal-> description,
                "precio_mensual" => $planPaypal-> precio_mensual,
                "precio_anual" => $planPaypal-> precio_anual,
                "month_free" => $planPaypal-> month_free,
                "id_plan_paypal_mensual" => $planPaypal-> id_plan_paypal_mensual,
                "id_plan_paypal_anual" => $planPaypal-> id_plan_paypal_anual,
                "id_product_paypal" => $planPaypal-> id_product_paypal,
                "product_paypal_id" => $planPaypal -> product_paypal_id,
                "created_at" => $planPaypal->created_at->format("Y-m-d h:i:s")
            ]
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $planPaypal = PlanPaypal::findOrFail($id);

        $plan_mensual =[
             [
                "op" => "replace",
                "path" => "/name",
                "value" => $request -> name." - MENSUAL",
             ],
             [
                "op" => "replace",
                "path" => "/description",
                "value" => $request -> description,
            ]
        ];

        $response_mensual = $this->paypalSubscription->updatePlanes($planPaypal-> id_plan_paypal_mensual, $plan_mensual);

        $plan_anual =[
            [
               "op" => "replace",
               "path" => "/name",
               "value" => $request -> name." - ANUAL",
            ],
            [
               "op" => "replace",
               "path" => "/description",
               "value" => $request -> description,
           ]
       ];

       $response_anual = $this->paypalSubscription->updatePlanes($planPaypal-> id_plan_paypal_anual, $plan_anual);

        $planPaypal-> update($request->all());

        return response()->json(["plan"=>
        [
            "id" => $planPaypal->id,
            "name" => $planPaypal-> name,
            "product" => $planPaypal-> product_paypal,
            "description" => $planPaypal-> description,
            "precio_mensual" => $planPaypal-> precio_mensual,
            "precio_anual" => $planPaypal-> precio_anual,
            "month_free" => $planPaypal-> month_free,
            "id_plan_paypal_mensual" => $planPaypal-> id_plan_paypal_mensual,
            "id_plan_paypal_anual" => $planPaypal-> id_plan_paypal_anual,
            "id_product_paypal" => $planPaypal-> id_product_paypal,
            "product_paypal_id" => $planPaypal -> product_paypal_id,
            "created_at" => $planPaypal->created_at->format("Y-m-d h:i:s")
        ]
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
