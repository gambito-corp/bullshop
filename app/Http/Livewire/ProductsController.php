<?php

namespace App\Http\Livewire;
use App\Http\Controllers\PruebaController;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use App\Traits\CartTrait;
use Livewire\WithFileUploads; //trait para subir imagenes
use Livewire\WithPagination; // para la paginacion
use App\Http\Controllers\Helpers;
use Illuminate\Support\Facades\Artisan;

class ProductsController extends Component
{
    use WithFileUploads;
    use withPagination;
    use CartTrait;


    public $costo,$Forzar, $imagen, $name, $barcode, $cost, $price,$stock,$alerts,$categoryid, $search,$image,$selected_id, $pageTitle,$componentName;
    // protected $listeners = ['asignarCosto' => '$refresh'];
    private $pagination=20;
    
    public function ScanCode($code)
    {
        $this->ScanearCode($code);
        $this->emit('global-msg', 'SE AGREGÓ EL PRODUCTO AL CARRITO');
    }

    public function asignarCosto(Product $product)
    {
        $product->costo = $this->costo;
        $product->update();
        $this->costo = 0;
        // dd($product);
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName ='Productos';
        $this->categoryid='Seleccionar';
        $this->costo = 0;
    }

    public function render()
    {
        if(strlen($this->search)>0){
            $products = Product::Join('categories as c','c.id','products.category_id') //uniendo
                ->select('products.*','c.name as category')
                ->where('products.name','like','%' . $this->search . '%')
                ->orWhere('products.barcode','like','%' . $this->search . '%')
                ->orWhere('c.name','like','%' . $this->search . '%')
                ->orderBy('products.name','asc')
                ->paginate($this->pagination);
        }else{
            $products = Product::Join('categories as c','c.id','products.category_id')
                ->select('products.*','c.name as category')
                ->orderBy('products.name','asc')
                ->paginate($this->pagination);
        }
        


        return view('livewire.products.component', [
            'data'=>$products,
            'categories'=> Category::orderBy('name','asc')->get()])
            ->extends('layouts.theme.app')
        ->section('content');
    }

    public function ResetUI()
	{
		$this->name ='';
        $this->barcode = '';
        $this->cost = '';
        $this->price = '';
        $this->categoryid="Seleccionar";
        $this->stock ='';
        $this->alerts ='';		
		$this->image = null;
		$this->search ='';
		$this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
		
	}
    public function CreateCB($item)
    {
        // dd($item);
        $imagen = new PruebaController();
        $imagen->imagen($item);
        $this->emit('CB','Codigo de Barras');
        // dd($this->imagen);
    }

    public function WorkerRun(){
        Artisan::call('queue:work', ['--stop-when-empty' => true]);
        
    }
    
        public function ForzarActualizado()
        {
            $Forzar = new PruebaController();
            $Forzar->ActualizarForzado(intval($this->Forzar));
            $this->Forzar = null;
        }

    

    
    ////////////
    // public function Store()
    // {
    //     //primero validamos que el name sea ingresado si o si que no quede null
    //     $rulles=[
    //         'name'=>'required|unique:products|min:3',
    //         'cost'=>'required',
    //         'price'=>'required',
    //         'stock'=>'required',
    //         'alerts'=>'required',
    //         'categoryid'=>'required|not_in:Seleccionar'
    //     ];

    //     $messages = [
    //         'name.required'=>'Por favor, ingrese el nombre del producto',
    //         'name.unique'=>'Ya existe un producto con ese nombre',
    //         'name.min'=>'El nombre del producto debe tener al menos 3 caracteres',
    //         'cost.required'=>'El costo es requerido',
    //         'price.required'=>'El precio es requerido',
    //         'stock.required'=>'El stock es requerido',
    //         'alerts.required'=>'Ingresar el valor mínimo en existencia',
    //         'categoryid.not_in'=>'Por favor, seleccione una categoria diferente a Seleccionar'

    //     ];
    //     //ejecutamos las validaciones
    //     $this->validate($rulles,$messages);

    //     //si pasamos todas las validaciones realizamos el registro
    //     $product = Product::create([
    //         'name'=> $this->name,
    //         'barcode'=> $this->barcode,
    //         'cost'=> $this->cost,
    //         'price'=> $this->price,
    //         'stock'=> $this->stock,
    //         'alerts'=> $this->alerts,
    //         'category_id'=> $this->categoryid,
    //     ]);

    //     //image
    //     $customFileName;
    //     if($this->image){
    //         $customFileName = uniqid() . '_.' . $this->image->extension();
    //         $this->image->storeAs('public/products', $customFileName);
    //         $product->image=$customFileName;
    //         $product->save();
    //     }

    //     $this->ResetUI();
    //     $this->emit('product-added','Producto Registrado');
    // }


    // public function Edit(Product $product){
    //     $this->name = $product->name;
    //     $this->barcode = $product->barcode;
    //     $this->cost = $product->cost;
    //     $this->price = $product->price;
    //     $this->stock = $product->stock;
    //     $this->alerts = $product->alerts;
    //     $this->categoryid =$product->category_id;
    //     $this->selected_id = $product->id;
    //     $this->image = null;

    //     $this->emit('modal-show','show modal');

    // }
    // //////////

    // public function Update()
    // {
        //     //primero validamos que el name sea ingresado si o si que no quede null
        //     $rulles=[
    //         'name'=>"required|min:3|unique:products,name, {$this->selected_id}",
    //         'cost'=>'required',
    //         'price'=>'required',
    //         'stock'=>'required',
    //         'alerts'=>'required',
    //         'categoryid'=>'required|not_in:Seleccionar'
    //     ];

    //     $messages = [
    //         'name.required'=>'Por favor, ingrese el nombre del producto',
    //         'name.unique'=>'Ya existe un producto con ese nombre',
    //         'name.min'=>'El nombre del producto debe tener al menos 3 caracteres',
    //         'cost.required'=>'El costo es requerido',
    //         'price.required'=>'El precio es requerido',
    //         'stock.required'=>'El stock es requerido',
    //         'alerts.required'=>'Ingresar el valor mínimo en existencia',
    //         'categoryid.not_in'=>'Por favor, seleccione una categoria diferente a Seleccionar'

    //     ];
    //     //ejecutamos las validaciones
    //     $this->validate($rulles,$messages);

    //     //si pasamos todas las validaciones realizamos el registro
    //     $product = Product::find($this->selected_id); 
    //     $product->update([
    //         'name'=> $this->name,
    //         'barcode'=> $this->barcode,
    //         'cost'=> $this->cost,
    //         'price'=> $this->price,
    //         'stock'=> $this->stock,
    //         'alerts'=> $this->alerts,
    //         'category_id'=> $this->categoryid,
    //     ]);

    //     //image
    //     $customFileName;
    //     if($this->image){
    //         $customFileName = uniqid() . '_.' . $this->image->extension();
    //         $this->image->storeAs('public/products', $customFileName);
    //         $imageTemp = $product->image; //imagen temporal
    //         $product->image=$customFileName;
    //         $product->save();
    //         if($imageTemp != null)
    //         {
    //             if(file_exists('storage/products/' . $imageTemp)){
    //                 unlink('storage/products/' . $imageTemp);
    //             }
    //         }
    //     }

    //     $this->ResetUI();
    //     $this->emit('product-updated','Producto Actualizado');
    // }
   

    // protected $listeners=[
    //     'deleteRow' =>'Destroy'
    // ];

    // public function Destroy(Product $product)
    // {
    //     $imageTemp = $product->image;//creamos una imagen temporal para despues eliminarla
    //     $product->delete();

    //     if($imageTemp !=null) {
    //         if(file_exists('storage/products/' . $imageTemp)){
    //             unlink('storage/products/' . $imageTemp);
    //         }
    //     }
    //     $this->ResetUI();
    //     $this->emit('product-delete','Producto Eliminado');
    // }
}
