<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'cotizacion_date',
        'total',];
    
        public function user(){
            return $this->belongsTo(User::class);
        }
        public function client(){
            return $this->belongsTo(Client::class);
        }
        public function cotizacionDetails(){
            return $this->hasMany(cotizacionDetail::class);
        }
        public function business()
        {
            return $this->belongsTo(Business::class);
        }
}
