<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Automattic\WooCommerce\Client;

class ProductsService
{
    private Product $product;
    private WoocomerceService $client;

    public function __construct(WoocomerceService $client)
    {
        $this->client = $client;
        $this->product = new Product();
    }

    public function getProducts($page, $perPage)
    {
        return $this->client->getProducts($page, $perPage);
    }
    public function getProduct($wpId)
    {
        return $this->client->getProduct($wpId);
    }

    public function saveOrUpdateProduct($value, $key = null)
    {
        $producto = $this->product->where('wp_id', $value->id)->first();

        if ($value->type == 'variable') {
            $this->manageVariations($value, $key, $producto != null);
        } else {
            if ($producto) {
                $this->actualizarProducto($value, $producto);
            } else {
                $this->crearProducto($value);
            }
        }
    }

    private function manageVariations($value, $key, $isUpdate)
    {
        foreach ($value->variations as $id) {
            $variacion = $this->client->getProduct($id);
            $producto = $this->product->where('wp_id', $id)->first();
            if ($isUpdate) {
                $this->saveOrUpdateProductoVariacion($value, $variacion, $producto);
            } else {
                $producto = new Product();
                $this->saveOrUpdateProductoVariacion($value, $variacion, $producto);
            }
        }
    }

    private function saveOrUpdateProductoVariacion($value, $variacion, $producto)
    {
        $this->populateProducto($producto, $value, $variacion);
        if ($producto->exists) {
            $producto->update();
        } else {
            $producto->save();
        }
    }

    private function actualizarProducto($value, $producto)
    {
        $this->populateProducto($producto, $value);
        $producto->update();
    }

    private function crearProducto($value)
    {
        $producto = new Product();
        $this->populateProducto($producto, $value);
        $producto->save();
    }

    private function populateProducto($producto, $value, $variacion = null)
    {
        $producto->category_id = $this->getCategoria($value->categories)->id;
        $producto->wp_id = $variacion ? $variacion->id : $value->id;
        $producto->name = $value->name;
        $producto->slug = $value->slug;
        $producto->permalink = $value->permalink;
        $producto->type = $value->type;
        $producto->status = $value->status;
        $producto->description = $value->description;
        $producto->barcode = $variacion ? $variacion->sku : $value->sku;
        $producto->price = $variacion ? $value->price : $value->price;
        $producto->stock = $variacion ? $variacion->stock_quantity : $value->stock_quantity;
        $producto->image = $value->images[0]->src ?? 'curso.png';
        $producto->costo = $this->getValueForKey($value->meta_data, $variacion ? 'purchase_product_variable' : 'purchase_product_simple') ?? 0;
        $producto->marca = $this->getValueFromArray($value->meta_data, 'Marca');
        $producto->talla = $variacion ? $this->getValueFromArray($variacion->meta_data, 'Talla') : null;
    }

    private function getValueForKey($array, $keyToFind)
    {
        foreach ($array as $item) {
            if (isset($item->key) && $item->key === $keyToFind) {
                return $item->value;
            }
        }
        return null;
    }

    private function getValueFromArray($array, $nameToFind)
    {
        foreach ($array as $item) {
            if (isset($item->name) && $item->name === $nameToFind) {
                return isset($item->options[0]) ? $item->options[0] : null;
            }
        }
        return null;
    }

    private function getCategoria($categories)
    {
        return Category::query()->where('wp_id', $categories[0]->id)->first();
    }

}
