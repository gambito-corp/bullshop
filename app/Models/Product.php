<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasFactory;
    protected $fillable = [
        'name',
        'wp_id',
        'slug',
        'permalink',
        'type',
        'status',
        'description',
        'barcode',
        'price',
        'stock',
        'marca',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); // 1 producto 1 categoria
    }


    public function getImagenAttribute(){
        $default = 'https://quimera360marketing.com/bullshop-place/wp-content/uploads/woocommerce-placeholder-700x700.png';

        if($this->image != 'curso.png')
            return (($this->image != $default) ? $this->image : $default);
        else
            return $default;
    }
}
