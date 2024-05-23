<?php

namespace App\Services;

use Automattic\WooCommerce\Client;

class WoocomerceService
{

    private Client $client;

    public function __construct()
    {
        $this->client = new Client(
            env('API_URL', 'forge'),
            env('API_PUBLIC_KEY', 'forge'),
            env('API_PRIVATE_KEY', 'forge'),
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );
    }

    public function getProducts($page, $perPage, $status = 'publish')
    {
        return $this->client->get('products?status='.$status.'&per_page='.$perPage.'&page='.$page);
    }
    public function getProduct($wpId)
    {
        return $this->client->get('products/'.$wpId);
    }

    public function getCategory($id = '', $perPage=100, $page=1)
    {
        if($id == ''){
            $respuesta = $this->client->get('products/categories?per_page='.$perPage.'&page='.$page);
        }else{
            $respuesta = $this->client->get('products/categories/'.$id);
        }
        return $respuesta;
    }

}
