<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name', 'email','nit_number', 'address', 'second_address','phone', 'second_phone',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
