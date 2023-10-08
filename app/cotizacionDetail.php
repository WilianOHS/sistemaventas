<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cotizacionDetail extends Model
{
    protected $fillable = [
        'cotizacion_id',
        'product_id',
        'quantity',
        'price',
        'discount',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
