<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'name', 'stock', 'image', 'price', 'sale_price',
        'presentation', 'weight', 'year', 'model','marca', 'status', 'category_id',
        'provider_id', 
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetails::class);
    }
}
