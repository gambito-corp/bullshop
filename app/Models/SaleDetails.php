<?php
//TODO: singularizar el modelo

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;
    protected $fillable= [
        'price',
        'costo',
        'quantity',
        'product_id',
        'sale_id'
    ];
    public function Producto()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
