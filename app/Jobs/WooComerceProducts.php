<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Helpers;

class WooCommerceProducts implements ShouldQueue
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
        dd($valor);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }

    /**
     * Extract the brand from the attributes.
     *
     * @param array $attributes
     * @return string
     */
    private function extractBrand($attributes)
    {
        dd($attributes);
        if (empty($attributes)) {
            return '';
        }

        $atributos = collect($attributes);
        $marca = $atributos->where('name', 'Marca')->first();

        return $marca->options[0] ?? '';
    }

    /**
     * Process and save the product.
     *
     * @param int $id
     * @param Category $categoria
     * @param string $marca
     * @param object|null $productData
     * @return void
     */
    private function processProduct($id, $categoria, $marca, $productData = null)
    {
        $productData = $productData ?? Helpers::getProduct($id);
        $productData = collect($productData);
        $meta_data = collect($productData['meta_data']);
        $costo = $this->extractCosto($meta_data, $productData['type'] == 'variable');

        $producto = Product::firstOrNew(['wp_id' => $id]);
        $producto->fill([
            'category_id' => $categoria->id,
            'name' => $productData['name'],
            'slug' => $productData['slug'],
            'permalink' => $productData['permalink'],
            'type' => $productData['type'],
            'status' => $productData['status'],
            'description' => $productData['description'],
            'barcode' => $productData['sku'],
            'price' => $productData['price'],
            'costo' => $costo,
            'stock' => $productData['stock_quantity'],
            'marca' => $marca,
            'image' => $productData['images'][0]['src'] ?? 'curso.png',
        ]);
        $producto->save();
    }

    /**
     * Extract the cost from meta data.
     *
     * @param \Illuminate\Support\Collection $meta_data
     * @param bool $isVariable
     * @return float
     */
    private function extractCosto($meta_data, $isVariable)
    {
        $key = $isVariable ? 'purchase_product_variable' : 'purchase_product_simple';
        $costo = $meta_data->where('key', $key)->first();

        if ($costo) {
            return $costo->value ?? $costo['value'] ?? 0;
        }

        return 0;
    }
}
