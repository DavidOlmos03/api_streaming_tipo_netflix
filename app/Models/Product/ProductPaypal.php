<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPaypal extends Model
{
    use HasFactory;

    // Se utiliza $fillable para permitir la asignación masiva de los atributos que estan en la lista, esto para fines de seguridad.
    // tambien se podria utilizar $guarded teniendo en cuanta que todos los atributos fuera del arreglo estarian permitidos, contrario a $fillable
    protected $fillable = [
        "name",
        "type",
        "category",
        "description",
        "id_product_paypal"
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
}
