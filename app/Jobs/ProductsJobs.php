<?php
namespace App\Jobs;

use App\Services\ProductsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProductsJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $valor;
    public $key;

    public function __construct($valor, $key = null)
    {
        $this->valor = $valor;
        $this->key = $key;
    }

    public function handle(ProductsService $productsService)
    {
        try {
            $productsService->saveOrUpdateProduct($this->valor, $this->key);
        } catch (\Exception $e) {
            Log::error('Error al procesar el trabajo: ' . $e->getMessage());
            // Puedes registrar información adicional del error si es necesario
            Log::error($e->getTraceAsString());
            throw $e; // Re-lanza la excepción para que el trabajo se marque como fallido
        }
    }
}
