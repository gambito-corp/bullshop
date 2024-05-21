<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable= [
        'total',
        'descuento',
        'final',
        'costoTotal',
        'items',
        'cash',
        'change',
        'status',
        'medio',
        'user_id',
        'company_id'
    ];

    public function Detalles(){
        return $this->hasMany(SaleDetails::class);
    }

    public function TipoPago(){
        return $this->hasMany(FormaDePago::class); 
    }
}
