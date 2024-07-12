<?php

namespace App\Models\Streaming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class StreamingActor extends Model
{
    use HasFactory;
    // Para que no se elimine el registro, sino que se agregue al delete_at
    use SoftDeletes;
    protected $fillable = [
        "streaming_id",
        "actor_id",
        "state"
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

    function streaming() {
        return $this->belongsTo(Streaming::class);
    }

}
