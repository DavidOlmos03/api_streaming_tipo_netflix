<?php

namespace App\Models\Streaming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Streaming extends Model
{
    use HasFactory;
    // Para que no se elimine el registro, sino que se agregue al delete_at
    use SoftDeletes;
    // se utiliza en los modelos para especificar cuáles campos pueden ser asignados masivamente.
    // Esto es parte del sistema de protección contra asignación masiva (mass assignment) que ayuda a evitar vulnerabilidades de seguridad en la aplicación.
    //
    protected $fillable = [
        "title",
        "slug",
        "imagen",
        "subtitle",
        "description",
        "genre_id",
        "vimeo_id",
        "time",
        "tags",
        "state",
        "type"
    ];

        // Se establece la fecha de creación de un plan
        function setCreatedAtAttribute($value){
            date_default_timezone_set("America/Lima");
            $this->attributes["created_at"] = Carbon::now();
        }

        // Se establece la fecha de edición de un plan
        function setUpdatedAtAttribute(){
            date_default_timezone_set("America/Lima");
            $this->attributes["updated_at"] = Carbon::now();
        }

        function genre(){
            return $this->belongsTo(Genre::class);
        }
        function actors(){
            return $this->hasMany(StreamingActor::class);
        }

        function getTags(){
            // 5,6,7 -> [5,6,7]
            $tags = explode(",",$this->tags);
            $tags_model = Tag::whereIn("title",$tags)->get();
            return $tags_model;
        }
        // scope es una palabra reservada para indicar que es un scope, pero para llamar a la función solo
    // se debe utilizar el filterGenres
    function scopefilterStreamings($query, $search, $state){
        if($state){
            $query -> where("state",$state);
        }
        if ($search) {
            $query->where("title","like","%".$search."%");
        }
        return $query;
    }
}
