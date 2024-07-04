<?php

namespace App\Models\Streaming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "full_name",
        "imagen",
        "type",
        "state",
        "profession"
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

    // scope es una palabra reservada para indicar que es un scope, pero para llamar a la función solo
    // se debe utilizar el filterGenres
    function scopefilterActors($query, $search, $state){
        if($state){
            $query -> where("state",$state);
        }
        if ($search) {
            $query->where("full_name","like","%".$search."%");
        }
        return $query;
    }
}
