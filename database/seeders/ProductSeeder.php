<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Helpers;
use App\Jobs\WooComerceProducts;
use Illuminate\Support\Facades\Artisan;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Artisan::call('queue:work');
        $coleccion = collect();
        for ($i=1; $i < 33; $i++) { 
            $agregarPagina = Helpers::getProducts(100, $i);
            if($agregarPagina == []){
                break;
            }else{
                foreach ($agregarPagina as $key => $value) {
                    $coleccion->push($value);
                }
            }
        }
        $coleccion->each(function($item, $key) {
            WooComerceProducts::dispatchAfterResponse($item);
        });
    }
}
