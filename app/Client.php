<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'dui',
        'nit',
        'nrc',
        'giro',
        'address',
        'phone',
        'email',
    ];
    
}
