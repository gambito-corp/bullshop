<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaDePago extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'tipo',
        'valor',
    ];


    public function VentaRelacionada()
    {
        return $this->belongsTo(Sale::class); 
    }

}
