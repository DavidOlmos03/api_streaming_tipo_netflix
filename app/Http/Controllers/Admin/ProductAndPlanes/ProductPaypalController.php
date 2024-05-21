<?php
namespace App\Http\Controllers\Admin\ProductAndPlanes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\PaypalSubcription;



class ProductPaypalController extends Controller
{
    public $paypalSubcription;
    public function __construct(PaypalSubcription $paypalSubcription) {
       $this->paypalSubcription = $paypalSubcription;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd($this->paypalSubcription->getProducts());  //Esto es para que Laravel imprima el contenido de lo que esta dentro de dd() y retenga la depuración ie el resto de la función no se ejecuta
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
        $product = [
            'name' => $request -> name,
            'description' => $request -> description,
            'type' => $request -> type,
            'category' => $request -> category,
            'image_url' => 'https://avatars.githubusercontent.com/u/15802366?s=460&u=ac6cc646599f2ed6c4699a74b15192a29177f85a&v=4',
            'home_url' => 'https://github.com/leifermendez/laravel-paypal-subscription',
        ];
        dd($this->paypalSubcription->storeProducts($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($this->paypalSubcription->showProduct($id));
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
        $product =[
             [
            "op" => "replace",
            "path" => "/".$request -> path,
            "value" => $request -> value
        ]
    ];
        dd($this->paypalSubcription->updateProducts($id,$product));
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
