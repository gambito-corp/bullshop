<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Helpers;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach (Helpers::getCategory() as $category) {
            $categoria = new Category();
            $categoria->name = $category->name;
            $categoria->wp_id = $category->id;
            $categoria->slug = $category->slug;
            $categoria->description = $category->description;
            $categoria->display = $category->display;
            $categoria->image = $category->image;
            $categoria->save();
        }
    }
}
