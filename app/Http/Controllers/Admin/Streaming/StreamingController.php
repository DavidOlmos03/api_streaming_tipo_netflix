<?php

namespace App\Http\Controllers\Admin\Streaming;

use App\Http\Controllers\Controller;
use App\Models\Streaming\Streaming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Resources\Streaming\StreamingCollection;
use App\Http\Resources\Streaming\StreamingResource;
class StreamingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search = $request->get("search");
        $state = $request->get("state");

        $streamings = Streaming::filterStreamings($search, $state) -> orderBy("id","desc")->get();

        return response()->json([
            "message" => 200,
            "streamings" => StreamingCollection::make($streamings), //->API RESORCE
        ]);

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
        $streaming_v = Streaming::where("title",$request->title)->where("type",$request->type)->first();
        if ($streaming_v) {
            # code...
            return response()->json([
                "message" => 403,
                "message_text" => "EL STREAMING YA EXISTE"
            ]);
        }

        if ($request->hasFile("img")) {
            # code...
            $path = Storage::putFile("streaming/",$request->file("img"));
            $request -> request->add(["imagen"=>$path]);
        }
        // teniendo un [2,3,4] -> 2,3,4 esto lo hace el formData para el tags, por eso la siguiente linea no es necesaria
        // $request ->request->add(["tags" => implode(",",$request->tags_a)])
        $request->request->add(["slug" => Str::slug($request->title)]);

        //OBS. Este $request->all() consulta todo lo definido en $fillable del modelo User.php
        //Por esta razón es importante desde el frontend enviar las solicitudes con el mismo nombre que estoy utilizando en la DDB en $fillable
        $streaming = Streaming::create($request->all());
        return response()->json([
            "message" => 200,
            "streaming" => StreamingResource::make($streaming),
            // "genre" =>  [
            //     "id"=>$streaming-> id,
            //     "title"=>$streaming-> title,
            //     "imagen"=>env("APP_URL")."/storage/".$streaming->imagen,
            //     "type"=>$streaming-> type,
            //     "state"=>$streaming-> state,
            //     "created_at"=>$streaming-> created_at->format("Y-m-d h:i:s"),

            // ],
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
        $streaming_v = Streaming::where("id","<>",$id)->where("title",$request->title)->where("type",$request->type)->first();;
        if ($streaming_v) {
            # code...
            return response()->json([
                "message" => 403,
                "message_text" => "EL STREAMING YA EXISTE"
            ]);
        }
        $streaming = Streaming::findOrFail($id);
        if ($request->hasFile("img")) {
            if ($streaming->imagen) {
                Storage::delete($streaming->imagen);
            }
            $path = Storage::putFile("streaming/streamings",$request->file("img"));
            $request -> request->add(["imagen"=>$path]);
        }

        $request->request->add(["slug" => Str::slug($request->title)]);

        $streaming -> update($request->all());

        return response()->json([
            "message" => 200,
            "streaming" => StreamingResource::make($streaming),
            //  [
            //     "id"=>$streaming-> id,
            //     "title"=>$streaming-> title,
            //     "imagen"=>env("APP_URL")."/storage/".$streaming->imagen,
            //     "type"=>$streaming-> type,
            //     "state"=>$streaming-> state,
            //     "created_at"=>$streaming-> created_at->format("Y-m-d h:i:s"),

            // ],
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
        $streaming = Streaming::findOrFail($id);
        $streaming->delete();

        return response()->json(["message"=>200]);
    }
}
