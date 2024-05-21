<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'wp_id',
        'slug',
        'description',
        'display',
        'image',
    ];

    public function products(){
        return $this->hasMany(Product::class); // una categoria puede tener muchos productos
    }

    public function getImagenAttribute(){
        if($this->image !=null)
    return (file_exists('storage/categories/'. $this->image) ? $this->image : 'assets/img/nimg.jpg');
    else
    return 'https://quimera360marketing.com/bullshop-place/wp-content/uploads/woocommerce-placeholder-700x700.png';
    }

}



// assets/img/nimg.jpg