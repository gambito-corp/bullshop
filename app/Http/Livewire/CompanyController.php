<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Company;
use Livewire\WithPagination;

class CompanyController extends Component
{
    use WithPagination;
    public $name, $phone, $taxpayer_id, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->pageTitle = 'Información';
        $this->componentName = 'Clientes';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Company::where('name', 'like', '%' . $this->search . '%')
                ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        else{
            $data = Company::select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        }
        return view('livewire.company.component', [
            'data' => $data
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function ResetUI()
    {
        $this->name = '';
        // $this->address = '';
        $this->phone = '';
        $this->taxpayer_id = '';
        $this->search = '';
        $this->selected_id = 0;
        //oculta los errores de validación en el formulario
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(Company $company)
    {
        $this->selected_id = $company->id;
        $this->name = $company->name;
        // $this->address = $company->address;
        $this->phone = $company->phone;
        $this->taxpayer_id = $company->taxpayer_id;
        $this->emit('show-modal', 'open');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3|unique:companies,name',
            // 'address' => 'required|min:3',
            'taxpayer_id' => 'required|min:8',
        ];
        $messages = [
            'name.required' => 'Ingresá el nombre del Cliente',
            'name.min' => 'El nombre del Cliente debe tener al menos 3 caracteres',
            'name.unique' => 'El Cliente ya existe',
            // 'address.required' => 'Ingresá la dirección',
            // 'address.min' => 'la dirección debe tener al menos 3 caracteres',
            'taxpayer_id.required' => 'Ingresá el Numero de Documento',
            'taxpayer_id.min' => 'El Numero de Documento debe tener al menos 8 caracteres',
        ];
        $this->validate($rules, $messages);

        $company = Company::create([
            'name' => $this->name,
            // 'address' => $this->address,
            'phone' => $this->phone,
            'taxpayer_id' => $this->taxpayer_id,
        ]);
        $company->save();
        $this->ResetUI();
        $this->emit('company-added', 'Información del Cliente Registrada');
    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:3|unique:companies,name,{$this->selected_id}",
            // 'address' => 'required|min:3',
            'taxpayer_id' => 'required|min:8',
        ];
        $messages = [
            'name.required' => 'Ingresá el nombre del Cliente',
            'name.min' => 'El nombre del Cliente debe tener al menos 3 caracteres',
            'name.unique' => 'El Cliente ya existe',
            // 'address.required' => 'Ingresá la dirección',
            // 'address.min' => 'la dirección debe tener al menos 3 caracteres',
            'taxpayer_id.required' => 'Ingresá el Numero de Documento',
            'taxpayer_id.min' => 'El Numero de Documento debe tener al menos 8 caracteres',
        ];
        $this->validate($rules, $messages);
        $company = Company::find($this->selected_id);

        $company->update([
            'name' => $this->name,
            // 'address' => $this->address,
            'phone' => $this->phone,
            'taxpayer_id' => $this->taxpayer_id,
        ]);

        $company->save();

        $this->emit('company-updated', 'Se Actualizo la información del Cliente con Éxito');
        $this->ResetUI();
    }
    public function Destroy(Company $company)
    {
        $company->delete();
        $this->ResetUI();
        $this->emit('company-deleted', 'Información del Cliente eliminada');
    }
}
