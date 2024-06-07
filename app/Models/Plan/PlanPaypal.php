<?php

namespace App\Models\Plan;
use Carbon\Carbon;
use App\Models\Product\ProductPaypal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPaypal extends Model
{
    use HasFactory;

    // Se utiliza $fillable para permitir la asignación masiva de los atributos que estan en la lista, esto para fines de seguridad.
    // tambien se podria utilizar $guarded teniendo en cuanta que todos los atributos fuera del arreglo estarian permitidos, contrario a $fillable

    protected $fillable = [
        "name",
        "description",
        "precio_mensual",
        "precio_anual",
        "month_free",
        "id_plan_paypal_mensual",
        "id_plan_paypal_anual",
        "id_product_paypal",
        "product_paypal_id"
    ];

    // Se establece la fecha de creación de un plan
    function setCreatedAtAttribute($value){
        date_default_timezone_set("America/Lima");
        // La estención de la libreria PHP DataTime llamada Carbon se utiliza para trabajar con estas fechas
        $this->attributes["created_at"] = Carbon::now();
    }
    // Se establece la fecha de edición de un plan
    function setUpdatedAtAttribute(){
        date_default_timezone_set("America/Lima");
        $this->attributes["updated_at"] = Carbon::now();
    }
    // A travez del belongsTo "petenece a" accedo a los valores de ProductPaypal debido a que esta clase (PlanPaypal) requiere la llave foranea
    // "product_paypal_id"
    function product_paypal(){
        return $this->belongsTo(ProductPaypal::class);
    }
}
