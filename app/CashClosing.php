<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashClosing extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'cashopening_id',
        'closings_date',
        'closings_hour',
        'cash',
        'start_ticket',
        'end_ticket',
        'start_invoice',
        'end_invoice',
        'start_tax_credit',
        'end_tax_credit',
        'initial_balance',
        'daily_sales',
        'income',
        'vouchers',
        'cash_sales',
        'card_sales',
    ];
    
    
    public function sale(){
        return $this->hasMany(Sale::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function cashOpening()
    {
        return $this->hasMany(cashOpening::class);
    }
}
