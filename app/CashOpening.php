<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashOpening extends Model
{
    protected $fillable = [
        'date', 'opening_balance', 'income', 'voucher',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function cashClosing()
    {
        return $this->hasMany(CashClosing::class);
    }
}

