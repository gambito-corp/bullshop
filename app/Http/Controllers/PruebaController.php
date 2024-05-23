<?php

namespace App\Http\Controllers;

use App\Jobs\ProductsJobs;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductsService;
use App\Services\WoocomerceService;
use Automattic\WooCommerce\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers;
use DB;
use App\Models\Sale;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorSVG;
use Intervention\Image\Facades\Image;
use App\Jobs\WooCommerceProducts;
use Illuminate\Support\Facades\Artisan;

class PruebaController extends Controller
{



    public $ticket;
    public ProductsService $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }





    public function ActualizarForzado($id) :void
    {
        $product = Helpers::getProduct($id);
        $product = collect($product);




        if($product['parent_id']){
            // dd('¿Como es posible?');
            $padre = Helpers::getProduct($product['parent_id']);
            $padre = collect($padre);
            $marca = collect($padre['attributes']);
            $categoria = Category::where('name', $padre['categories'][0]->name)->first();
                if($marca->where('name', 'Marca')){
                    $marca = $marca->where('name', 'Marca')->first();
                    $marca = $marca->options[0];
                }
            // dd($marca, $product, $padre);
            $costo = collect($product['meta_data']);
            $costo->where('key', 'purchase_product_variable');
            if(!empty($costo)){
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


            $producto = Product::where('barcode', $product['sku'])->first();
            if($producto){
                $producto->category_id = $categoria->id;
                $producto->name = $product['name'];
                $producto->wp_id = $id;
                $producto->slug = $product['slug'];
                $producto->permalink = $product['permalink'];
                $producto->type = $product['type'];
                $producto->status = $product['status'];
                $producto->description = $product['description'];
                $producto->barcode = $product['sku'];
                $producto->price = $product['price'];
                $producto->costo = $costo;
                $producto->marca = $marca;
                $producto->stock = $product['stock_quantity'];
                $producto->image = isset($product['images'][0]->src) ? $product['images'][0]->src : 'curso.png';
                $test = $producto->update();
            }else{
                $producto = new Product();
                $producto->category_id = $categoria->id;
                $producto->name = $product['name'];
                $producto->wp_id = $id;
                $producto->slug = $product['slug'];
                $producto->permalink = $product['permalink'];
                $producto->type = $product['type'];
                $producto->status = $product['status'];
                $producto->description = $product['description'];
                $producto->barcode = $product['sku'];
                $producto->price = $product['price'];
                $producto->costo = $costo;
                $producto->marca = $marca;
                $producto->stock = $product['stock_quantity'];
                $producto->image = isset($product['images'][0]->src) ? $product['images'][0]->src : 'curso.png';
                $test = $producto->save();
            }
        }else{
            $marca = collect($product['attributes']);
            $categoria = Category::where('name', $product['categories'][0]->name)->first();
            if($marca->where('name', 'Marca')){
                $marca = $marca->where('name', 'Marca')->first();
                $marca = $marca->options[0];
            }
            $costo = collect($product['meta_data']);
            $costo = $costo->where('key', 'purchase_product_simple')->first();
            if(!empty($costo)){
                // dump($costo);
                // dump(!empty($costo), '!empty', $costo);
                if(isset($costo->value)){
                // dump(isset($costo->value), 'propiedad');
                    $costo = $costo->value;
                }elseif(isset($costo['value'])){
                // dump(isset($costo['value']), 'array');
                    $costo = $costo['value'];
                }else{
                    // dump('no hay nada');
                    $costo = 0;
                }
            // dd($costo, $product);
            }else{
                $costo = 0;
            }
            $producto = Product::where('barcode', $product['sku'])->first();
            if($producto){
                $producto->category_id = $categoria->id;
                $producto->name = $product['name'];
                $producto->wp_id = $id;
                $producto->slug = $product['slug'];
                $producto->permalink = $product['permalink'];
                $producto->type = $product['type'];
                $producto->status = $product['status'];
                $producto->description = $product['description'];
                $producto->barcode = $product['sku'];
                $producto->price = $product['price'];
                $producto->costo = $costo;
                $producto->marca = $marca;
                $producto->stock = $product['stock_quantity'];
                $producto->image = isset($product['images'][0]->src) ? $product['images'][0]->src : 'curso.png';
                $test = $producto->update();
            }else{
                $producto = new Product();
                $producto->category_id = $categoria->id;
                $producto->name = $product['name'];
                $producto->wp_id = $id;
                $producto->slug = $product['slug'];
                $producto->permalink = $product['permalink'];
                $producto->type = $product['type'];
                $producto->status = $product['status'];
                $producto->description = $product['description'];
                $producto->barcode = $product['sku'];
                $producto->price = $product['price'];
                $producto->costo = $costo;
                $producto->marca = $marca;
                $producto->stock = $product['stock_quantity'];
                $producto->image = isset($product['images'][0]->src) ? $product['images'][0]->src : 'curso.png';
                $test = $producto->save();
            }
        }
            // return redirect ()->route('productos');
        }

    public function ImprimirV1()
    {
        return view('Impresion.V1.barcode.index');
    }
    public function ejemplo()
    {
    //     // $revision = Helpers::getProduct(8919);
    //     // dd($revision);


    //     // $data = [
    //     //     'name' => 'All kinds of clothes.',
    //     //     'slug' => 'All kinds of clothes.'
    //     // ];
    //     // $data = Helpers::Woocomerce()->get('products/categories/77');
    //     // $salida = Helpers::updateCategory(109, $data);
    //     // dd('holi', $data, $salida);
    //     // dump(Helpers::reniecCheck('45789618'));
    //     // $this->Sembrar();
    //     // $categorias = Category::all();
    //     // dd($categorias);
    //     // dump(Helpers::reniecCheck('20112810791'));
    //     // Helpers::Impresion();
    //     $data = [
    //         [
    //             'Tipo' => 'yape',
    //             'Valor' => '20',
    //         ],
    //         [
    //             'Tipo' => 'plim',
    //             'Valor' => '20',
    //         ],
    //         [
    //             'Tipo' => 'transferencia',
    //             'Valor' => '20',
    //         ],
    //         [
    //             'Tipo' => 'tarjeta',
    //             'Valor' => '20',
    //         ],
    //         [
    //             'Tipo' => 'efectivo',
    //             'Valor' => '20',
    //         ],
    //         [
    //             'Tipo' => 'efectivo',
    //             'Valor' => '20',
    //         ],

    //     ];
    //     $collection = collect($data);
    //     // foreach ($collection as $key => $value) {
    //     //     $value = collect($value);
    //     //     if($value['Tipo'] == 'efectivo' && $collection->contains('Tipo', 'efectivo')){
    //     //        dump($collection->where('Tipo', 'efectivo')->sum('Valor'));
    //     //        dump($collection[$key]['Tipo'] += 20);
    //     //        dd($collection);
    //     //     }
    //     //     // dd('no se cumplio');
    //     //     // dump($value);
    //     // }
    //     dd($collection);
    }

    public function VerImpresion()
    {
        // $this->ticket = $ticket;
        // dd($this->ticket, $ticket);
        return redirect()->route('imprimir');
    }
    public function Imprimir()
    {
        $ticket = Sale::with('Detalles')->get()->last();
        $recibo = $ticket->Detalles->load('Producto');
        $componentName = 'Imprimir Ticket';
        $selected_id = '';
        return view('impresion', compact('ticket', 'recibo', 'componentName', 'selected_id'));
    }
    public function imagen($id)
    {
        # Crear generador
        $item = Product::where('barcode', $id)->first();
        $generador = new BarcodeGeneratorPNG();
        # Ajustes
        $texto = $id;
        $tipo = $generador::TYPE_CODE_128;
        $CB = $generador->getBarcode($texto, $tipo);
        # Sugerir nombre para guardar
        $nombreArchivo = $id." codigo_de_barras ".$item->name.".png";
        $ruta = public_path().'/CB/'.$nombreArchivo;
        // dd($ruta);
        // dd($ruta);
        $CB = Image::make($CB)->resize(75, 25);
        $imagen = Image::canvas(150, 100, '#fff')->insert($CB, 'bottom', 0, 40)->text($item->name, 10, 20)->text($item->barcode, 55, 70)->text(env('MONEDA', 'S/ '), 70, 80)->text($item->price, 80, 80);
        // $imagen->resize(400, 400);
        $imagen->save($ruta, 100);
        // $imagen->save(storage_path('\app\public\CB/'.$nombreArchivo));
        // return $imagen->response('png');


        # Imprimir encabezados
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=$nombreArchivo");
        echo $imagen;
    }

    public function ActualizarWC(){
        $oldCategory = Category::all();
        foreach (Helpers::getCategory() as $key => $category) {
            $categoria = new Category();

            if(empty($oldCategory->toArray())){
                $categoria->name = $category->name;
                $categoria->wp_id = $category->id;
                $categoria->slug = $category->slug;
                $categoria->description = $category->description;
                $categoria->display = $category->display;
                $categoria->image = $category->image;
                $categoria->save();
            }else{
                $oldCategoryNow = $oldCategory->where('name', $category->name)->first();
                if($oldCategoryNow){
                    $actualizar = $oldCategory->where('name', $category->name)->first();
                        $actualizar->name = $category->name;
                        $actualizar->wp_id = $category->id;
                        $actualizar->slug = $category->slug;
                        $actualizar->description = $category->description;
                        $actualizar->display = $category->display;
                        $actualizar->image = $category->image;
                        $actualizar->update();
                }else{
                    // dd('hola');
                    $categoria->name = $category->name;
                    $categoria->wp_id = $category->id;
                    $categoria->slug = $category->slug;
                    $categoria->description = $category->description;
                    $categoria->display = $category->display;
                    $categoria->image = $category->image;
                    $categoria->save();
                }
            }
            // dump(Helpers::getCategory($category->id));
        }
        // dump($oldCategory);
        // dd('fin de Ejecucion');
        return redirect ()->route('productos');
    }

    public function actualizarWP()
    {
        dump('inicio');
        $coleccion = collect();

        for ($i = 1; $i < 33; $i++) {
            $agregarPagina = $this->productsService->getProducts($i, 100);
            if (empty($agregarPagina)) {
                break;
            }
            $coleccion = $coleccion->merge($agregarPagina);
        }

        $coleccion->each(function ($item, $key) {
            ProductsJobs::dispatch($item, $key);
        });

        return redirect()->route('productos');
    }



    public function Sembrar()
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

        $categorias = Category::all();

        for ($i = 1; $i < 33; $i++){
            $agregarPagina = Helpers::getProducts(100, $i);

            if($agregarPagina == []){
                break;
            }else{
                foreach ($agregarPagina as $pagina) {

                    $product = new Product();
                    if(isset($pagina->categories[0]->name))
                    {
                        $categoria = $categorias->where('name', $pagina->categories[0]->name)->first();
                        $product->category_id = $categoria->id;
                    }

                    $product->name = $pagina->name;
                    $product->wp_id = $pagina->id;
                    $product->slug = $pagina->slug;
                    $product->permalink = $pagina->permalink;
                    $product->type = $pagina->type;
                    $product->status = $pagina->status;
                    $product->description = $pagina->description;
                    $product->barcode = $pagina->sku;
                    $product->price = $pagina->price;
                    $product->stock = $pagina->stock_quantity;
                    if(isset($pagina->attributes[0]->options[0]))
                    {
                        $product->marca = $pagina->attributes[0]->options[0];
                    }else{
                        $product->marca = null;
                    }
                    if(isset($pagina->images[0]->src))
                    {
                        $product->image = $pagina->images[0]->src;
                    }else{
                        $product->image = 'curso.png';
                    }
                    $product->save();

                }

            }
        }
    }
}
