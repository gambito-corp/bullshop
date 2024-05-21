<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Exception;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Helpers;

class WooComerceProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $valor;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($valor)
    {
        $this->valor = $valor;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categoria = Category::where('name', $this->valor->categories[0]->name)->first();
        if(!empty($this->valor->attributes)){
            $atributos = collect($this->valor->attributes);
            $marca = $atributos->where('name', "Marca")->first();
            $option = $marca->options;
            $marca = $option[0];
        }else{
            $marca = '';
        }
        
        try {
            if($this->valor->type == 'variable'){
                foreach ($this->valor->variations as $id){
                    $item = Helpers::getProduct($id);
                    $item = collect($item);
                    $meta_data = collect($item['meta_data']);
                    if($meta_data->where('key', 'purchase_product_variable')->first()){
                        $costo = $meta_data->where('key', 'purchase_product_variable')->first();
                        if(isset($costo->value)){
                            $costo = $costo->value;
                        }elseif(isset($costo['value'])){
                            $costo = $costo['value'];
                        }else{
                            $costo = 0;
                        }
                    }else{
                        $costo = 0;
                    }
                    $producto = Product::where('wp_id', $id)->first();
                    if(!$producto){
                        $producto = new Product();
                        $producto->category_id = $categoria->id;
                        $producto->name = $item['name'];
                        $producto->wp_id = $id;
                        $producto->slug = $item['slug'];
                        $producto->permalink = $item['permalink'];
                        $producto->type = $item['type'];
                        $producto->status = $item['status'];
                        $producto->description = $item['description'];
                        $producto->barcode = $item['sku'];
                        $producto->price = $item['price'];
                        $producto->costo = $costo;
                        $producto->stock = $item['stock_quantity']; 
                        $producto->marca = $marca;
                        $producto->image = isset($item['images'][0]->src) ? $item['images'][0]->src : 'curso.png';
                        $test = $producto->save(); 
                    }else{
                        $producto->category_id = $categoria->id;
                        $producto->name = $item['name'];
                        $producto->wp_id = $id;
                        $producto->slug = $item['slug'];
                        $producto->permalink = $item['permalink'];
                        $producto->type = $item['type'];
                        $producto->status = $item['status'];
                        $producto->description = $item['description'];
                        $producto->barcode = $item['sku'];
                        $producto->price = $item['price'];
                        $producto->costo = $costo;
                        $producto->stock = $item['stock_quantity']; 
                        $producto->marca = $marca;
                        $producto->image = isset($item['images'][0]->src) ? $item['images'][0]->src : 'curso.png';
                        $test = $producto->update(); 
                    }
                }
            }else{
                $meta_data = collect($this->valor->meta_data);
                if($meta_data->where('key', 'purchase_product_simple')){
                    $costo = $meta_data->where('key', 'purchase_product_simple')->first();
                        if(isset($costo->value)){
                            $costo = $costo->value;
                        }elseif(isset($costo['value'])){
                            $costo = $costo->value;
                        }else{
                            $costo = 0;
                        }
                    }else{
                        $costo = 0;
                    }
                    $producto = Product::where('wp_id', $this->valor->id)->first();
                if(!$producto){
                    $producto = new Product();
                    $producto->category_id = $categoria->id;
                    $producto->name = $this->valor->name;
                    $producto->wp_id = $this->valor->id;
                    $producto->slug = $this->valor->slug;
                    $producto->permalink = $this->valor->permalink;
                    $producto->type = $this->valor->type;
                    $producto->status = $this->valor->status;
                    $producto->description = $this->valor->description;
                    $producto->barcode = $this->valor->sku;
                    $producto->price = $this->valor->price;
                    $producto->costo = $costo;
                    $producto->stock = $this->valor->stock_quantity; 
                    $producto->marca = $marca;
                    $producto->image = isset($this->valor->images[0]->src) ? $this->valor->images[0]->src : 'curso.png';
                    $test = $producto->save();
                }else{
                    $producto->category_id = $categoria->id;
                    $producto->name = $this->valor->name;
                    $producto->wp_id = $this->valor->id;
                    $producto->slug = $this->valor->slug;
                    $producto->permalink = $this->valor->permalink;
                    $producto->type = $this->valor->type;
                    $producto->status = $this->valor->status;
                    $producto->description = $this->valor->description;
                    $producto->barcode = $this->valor->sku;
                    $producto->price = $this->valor->price;
                    $producto->costo = $costo;
                    $producto->stock = $this->valor->stock_quantity; 
                    $producto->marca = $marca;
                    $producto->image = isset($this->valor->images[0]->src) ? $this->valor->images[0]->src : 'curso.png';
                    $test = $producto->update();
                }
            }
        } catch (Exception $e) {
            Log::info($e);
        }
        
    }
}
