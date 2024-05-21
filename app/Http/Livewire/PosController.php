<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Darryldecode\Cart\Facades\CartFacade as Cart; //lib carrito
use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Traits\CartTrait;
use App\Http\Controllers\Helpers;
use App\Http\Controllers\PruebaController;
use App\Models\FormaDePago;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use stdClass;
use Illuminate\Http\Request;

class PosController extends Component
{
    use CartTrait;

    public $total, $totalProductos, $itemsQuantity, $efectivo, $change, $dni, $telefono, $direccion, $nombre, $descuento, $totalAbsoluto, $montoMedio, $collection;
    public $productosImpresion;
    public $productosImpresion2;
    public $Descuento;
    public $Tipo;
    public $guardar;
    public $producto;
    public $producto1;
    public $producto2;
    public $producto3;
    public $producto4;
    public $producto5;
    public $producto6;
    public $producto7;
    public $producto8;
    public $producto9;
    public $resultado1;
    public $resultado2;
    public $resultado3;
    public $resultado4;
    public $resultado5;
    public $resultado6;
    public $resultado7;
    public $resultado8;
    public $resultado9;
    public $respuesta1;
    public $respuesta2;
    public $respuesta3;
    public $respuesta4;
    public $respuesta5;
    public $respuesta6;
    public $respuesta7;
    public $respuesta8;
    public $respuesta9;
    public $items;
    public $dineros;
    public $componentName = 'Cerrando Venta';
    public $selected_id = 'Cerrando Venta';
    public $resto;
    
    public function mount()
    {
        $this->efectivo = 0;
        $this->producto1 = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->guardar = false;
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->Descuento = Collect();
        $this->resto = Cart::getTotal();
        $this->Tipo = Collect();
    }
    public function render()
    {
        return view('livewire.pos.component', [
            'denominations' => Denomination::orderBy('value', 'desc')->get(),
            'cart' => Cart::getContent()->sortBy('id')
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
        'clearEfecty' => 'clearEfecty',
        'searchProduct' => 'searchProduct',
    ];
    public function ScanCode($barcode, $cant = 1)
    {
        $this->ScanearCode($barcode, $cant);
    }
    public function increaseQty(Product $product, $cant = 1)
    {
        $this->IncreaseQuantity($product, $cant);
    }
    public function updateQty(Product $product, $cant = 1)
    {
        if ($cant <= 0)
            $this->removeItem($product->id);
        else
            $this->updateQuantity($product, $cant);
    }
    public function decreaseQty($productId)
    {
        $this->decreaseQuantity($productId);
    }
    public function clearCart()
    {
        $this->trashCart();
    }
    public function searchProduct()
    {
        $this->emit('search-product', 'search');
    }
    public function clearEfecty()
    {
        $this->efectivo = 0;
        $this->change = 0;
        $this->emit('clear-efecty', 'Efectivo y Cambio Vacio');
    }
    public function guardarCliente()
    {
        $respuesta = Helpers::reniecCheck($this->dni);
        
        $this->nombre = $respuesta['name'];
        
        $cliente = Company::where('taxpayer_id', $respuesta['taxpayer_id'])->first();
        if($cliente){
            $cliente->name = $respuesta['name'];
            $cliente->taxpayer_id = $respuesta['taxpayer_id'];
            $cliente->update();
        }else{
            $cliente = new Company();
            $cliente->name = $respuesta['name'];
            $cliente->taxpayer_id = $respuesta['taxpayer_id'];
            $cliente->save();
            
        }
        return $cliente;
    }
   
    public function ACash($tipo, $value)
    {
        if($value >= 1)
        {
            $ejem1 = [
                'Tipo' => $tipo,
                'Valor' => ($this->resto <= $value) ? $this->resto : $value
            ];
            $this->Tipo->push($ejem1);
            $this->efectivo += ($value == 0 ? $this->total : $value);
            $this->change = ($this->efectivo - $this->total);
            $this->resto = $this->total - $this->efectivo;
        }

        $this->montoMedio = 0;
    }

    public function Descuento($item)
    {
        $resultado = intval($this->producto) * $item['quantity'];
        $resultado = $resultado/$item['quantity'];
        $objeto = [
            'item_id' => $item['id'],
            'item_name' => $item['name'],
            'resultado' => $resultado,
            'descuento' => ($item['quantity'] * $item['price']) - $resultado,
            'descuentoUnitario' => $item['price'] - $resultado/$item['quantity'],
        ];
        $this->total = $this->total - $objeto['descuento'];
        $this->Descuento->push($objeto);
        $this->producto = 0;
    }
    

    public function saveSale()
    {
        $cliente = $this->guardarCliente();
        if ($this->total <= 0) {
            $this->emit('sale-error', 'Agrega Productos a la Venta');
            return;
        }
        if ($this->efectivo <= 0) {
            $this->emit('sale-error', 'Ingrese el Efectivo');
            return;
        }
        if ($this->total > $this->efectivo) {
            $this->emit('sale-error', 'El Efectivo Debe ser Mayor o Igual al Total');
            return;
        }
        DB::beginTransaction();
        $SALE = new Sale();
        $SALEDETAIL = new SaleDetails();
        $descuento = 0;

        try { 
            
            $items = Cart::getContent();
            $costoTotal = 0;
            if($this->Descuento->isEmpty())
            {
                foreach ($items as $key => $value) {
                    
                    $Producto = Product::where('id', $value['id'])->first();
                    $costoTotal += $Producto->costo * $value['quantity'];
                    $resultado = $value['price'] * $value['quantity'];
                    $resultado = $resultado/$value['quantity'];
                    $objeto = [
                        'item_id' => $value['id'],
                        'item_name' => $value['name'],
                        'item_quantity' => $value['quantity'],
                        'costo' => $Producto->costo,
                        'resultado' => $resultado,
                        'descuento' => ($value['quantity'] * $value['price']) - $resultado,
                        'descuentoUnitario' => $value['price'] - $resultado/$value['quantity'],
                    ];
                    $this->Descuento->push($objeto);
                }
                $descuento = 0;
            }else{
                
                
                $collection2 = collect();
                $crearD = collect();
                
                foreach ($items as $key => $value) {
                    if($this->Descuento->where('item_id', $value['id'])->first()){
                        
                        // dump('if');
                        $Producto = Product::where('id', $value['id'])->first();
                        $costoTotal += $Producto->costo * $value['quantity'];
                        $collection = $this->Descuento->where('item_id', $key)->first();
                        $resultado = $collection['resultado']/$value['quantity'];
                        $objeto = [
                            'item_id' => $value['id'],
                            'item_name' => $value['name'],
                            'item_quantity' => $value['quantity'],
                            'costo' => $Producto->costo,
                            'resultado' => $resultado,
                            'descuento' => ($value['quantity'] * $value['price']) - $resultado,
                            'descuentoUnitario' => $value['price'] - $resultado/$value['quantity'],
                        ];
                        if($this->Descuento->where('item_id', $key)->count() == 2){
                            $this->Descuento->where('item_id', $key)->pop();
                        }
                        $collection2->push($objeto);
                    }else{
                        $Producto = Product::where('id', $value['id'])->first();
                        $costoTotal += $Producto->costo * $value['quantity'];
                        $resultado = $value['price'] * $value['quantity'];
                        $resultado = $resultado/$value['quantity'];
                        $objeto = [
                            'item_id' => $value['id'],
                            'item_name' => $value['name'],
                            'item_quantity' => $value['quantity'],
                            'costo' => $Producto->costo,
                            'resultado' => $resultado,
                            'descuento' => ($value['quantity'] * $value['price']) - $resultado,
                            'descuentoUnitario' => $value['price'] - $resultado/$value['quantity'],
                        ];
                        $collection2->push($objeto);
                        $crearD = array_push($objeto);
                    }
                    
                }
                $this->Descuento = null;
                $this->Descuento = $collection2;
                foreach ($this->Descuento as $key => $value) {
                    $descuento +=$value['descuento'];
                }
            }
            
            $sale = Sale::create([
                'total' => intval($this->total) + intval($descuento),
                'descuento' => intval($descuento),
                'final' => intval($this->total),
                'costoTotal' => $costoTotal,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
                'company_id' => $cliente->id
            ]);
            if ($sale) {
                foreach ($this->Tipo as $key => $value) {
                    FormaDePago::create([
                        'sale_id'  => $sale->id,
                        'tipo'     => $value['Tipo'] ,
                        'valor'    => $value['Valor'] ,
                    ]);
                }
                foreach ($this->Descuento as $key => $item) {
                    $saleD = SaleDetails::create([
                        'price' => $item['resultado'],
                        'costo' => $item['costo'],
                        'quantity' => $item['item_quantity'],
                        'product_id' => $item['item_id'],
                        'sale_id' => $sale->id,
                    ]);

                    $product = Product::find($saleD->product_id);
                    $product->stock -= $saleD->quantity;
                    $data = [
                        'stock_quantity' => $product->stock
                    ];
                    if($product->type == 'simple'){
                        Helpers::updateProducts($product->wp_id, $data);
                    }else{
                        $wpProduct = Helpers::getProduct($product->wp_id);
                        Helpers::updateProductsVariation($wpProduct->parent_id, $product->wp_id, $data);
                    }
                    // TODO: aqui esta la chicha hacer los movimientos de WP en esta transaccion
                    $product->save();  
                }
            }
            DB::commit();
            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok', 'Venta Registrada Con Éxito');
            $this->emit('print-ticket', $sale->id);
        } catch (Exception $e) {
            // TODO: Aqui revertir las acciones de WP en caso de error
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());
        }
        $impresion = new pruebaController();
        $impresion->VerImpresion($this->productosImpresion);
    }

    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }
}