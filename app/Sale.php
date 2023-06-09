<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'sale_date',
        'cash',
        'total',
        'status',
        'document_type',
        'document_number',
        'payment_method',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function saleDetails(){
        return $this->hasMany(saleDetail::class);
    }
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    public function printer()
    {
        return $this->belongsTo(Printer::class);
    }

}
