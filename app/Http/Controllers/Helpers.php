<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Automattic\WooCommerce\Client as Woocomerce; 
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;



class Helpers extends Controller
{

    public static function Impresion()
    {
        $profile = CapabilityProfile::load("simple");
        // $connector = new WindowsPrintConnector("smb://usuario:pass@computer/printer");
        $connector = new WindowsPrintConnector("Microsoft Print to PDF");
        $printer = new Printer($connector, $profile);
        $printer -> text("Hello World!\n");
        $printer -> cut();
        $printer -> close();
    }


    
    // TODO: scan sin foco Impresion de tiket
    public static function Woocomerce()
    {
        $woocomerce = new Woocomerce(
            env('API_URL', 'forge'),
            env('API_PUBLIC_KEY', 'forge'),
            env('API_PRIVATE_KEY', 'forge'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false
            ]
        );
        return $woocomerce;
    }

    public static function getCategory($id = '', $perPage=100, $page=1)
    {
        if($id == ''){
            $respuesta = Helpers::Woocomerce()->get('products/categories?per_page='.$perPage.'&page='.$page);
        }else{
            $respuesta = Helpers::Woocomerce()->get('products/categories/'.$id);
        }
        return $respuesta;
    }

    public static function createCategory($data)
    {
        return Helpers::Woocomerce()->post('products/categories', $data);
    }

    public static function updateCategory($wp_id, $data)
    {
        
        return Helpers::Woocomerce()->put('products/categories/'.$wp_id, $data);
    }

    public static function deleteCategory($wp_id)
    {
        
        return Helpers::Woocomerce()->delete('products/categories/'.$wp_id, ['force' => true]);
    }

    public static function getProducts($perPage=100, $page=1)
    {
        return Helpers::Woocomerce()->get('products?per_page='.$perPage.'&page='.$page);
    }

    public static function getProduct($wp_id)
    {
        return Helpers::Woocomerce()->get('products/'.$wp_id);
    }

    public static function getTags()
    {
        return Helpers::Woocomerce()->get('products/reviews');
    }

    public static function getTag($wp_id)
    {
        return Helpers::Woocomerce()->get('products/tags/'.$wp_id);
    }
    public static function createProducts($data)
    {
        // $data = [
        //     'name' => 'Premium Quality',
        //     'type' => 'simple',
        //     'regular_price' => '21.99',
        //     'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
        //     'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
        //     'categories' => [
        //         [
        //             'id' => 9
        //         ],
        //         [
        //             'id' => 14
        //         ]
        //     ],
        //     'images' => [
        //         [
        //             'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
        //         ],
        //         [
        //             'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
        //         ]
        //     ]
        // ];
        return Helpers::Woocomerce()->post('products', $data);
    }

    public static function updateProducts($wp_id, $data)
    {
        // $data = [
        //     'regular_price' => '24.54'
        // ];
        
        return Helpers::Woocomerce()->put('products/'.$wp_id, $data);
    }
    
    public static function updateProductsVariation($parent, $wp_id, $data)
    {
        // $data = [
        //     'regular_price' => '24.54'
        // ];
        
        return Helpers::Woocomerce()->put('products/'.$parent.'/variations/'.$wp_id, $data);
    }


    public static function deleteProducts($wp_id)
    {
        
        return Helpers::Woocomerce()->delete('products/'.$wp_id, ['force' => true]);
    }
    


    public static function reniecCheck($numero, $token = '')
    {
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Referer' => 'https://apis.net.pe/api-consulta-dni',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $numero]
        ];
        if (strlen($numero) == 11) {
            $res = $client->request('GET', '/v1/ruc', $parameters);
        }elseif (strlen($numero) == 8) {
            $res = $client->request('GET', '/v1/dni', $parameters);
        }elseif ($numero == 0) {
            $respuesta = collect(
                [ 
                 'name' => 'cliente Anonimo',
                //  'address' => null,
                 'taxpayer_id' => null,
                 ]
             );
             return $respuesta->all();
        }else{
            dd('error');
        }
        $response = json_decode($res->getBody()->getContents(), true);
        $respuesta = collect(
           [ 
            'name' => $response['nombre'],
            // 'address' => $response['direccion'],
            'taxpayer_id' => $response['numeroDocumento'],
            ]
        );
        return $respuesta->all();
        
        
    }

}
