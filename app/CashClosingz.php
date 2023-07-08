<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashClosingz extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'closings_date',
        'closings_hour',
        'start_ticket',
        'end_ticket',
        'start_invoice',
        'end_invoice',
        'start_tax_credit',
        'end_tax_credit',
        'total_sale_ticket',
        'total_sale_invoice',
        'total_sale_tax_credit'
    ];
    
    public function sale(){
        return $this->hasMany(Sale::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
