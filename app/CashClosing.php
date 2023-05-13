<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashClosing extends Model
{
    protected $fillable = [
        'type', 
        'closings_date',
        'user_id',
        'tickets',
        'invoices',
        'tax_credits',
        'initial_balance',
        'income',
        'vouchers',
        'cash_payments',
        'card_payments',
        'cash',
        'difference'
    ];
    public function sale(){
        return $this->hasMany(Sale::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
