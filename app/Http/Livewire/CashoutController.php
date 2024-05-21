<?php

namespace App\Http\Livewire;

use App\Models\FormaDePago;
use Livewire\Component;
use App\Models\User;
use App\Models\Sale;
use Carbon\Carbon;


class CashoutController extends Component
{
    public $fromDate, $toDate, $userid, $total, $items, $sales, $details, $FormasDePago;

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->userid = 0;
        $this->total = 0;
        $this->sales = [];
        $this->details = [];
        $this->FormasDePago = collect();
        
    }

    public function render()
    {
        return view('livewire.cashout.component', [
            'users' => User::orderBy('name', 'asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Consultar()
    {
        $fi=Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $ff=Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';
        $this->sales = Sale::whereBetween('created_at', [$fi, $ff])
        ->where('status','Paid')
        ->where('user_id', $this->userid)
        ->get();
        foreach ($this->sales as $key => $value) {
            $FormasDePago = collect();
            $FormasDePago = FormaDePago::whereBetween('created_at', [$fi, $ff])
            ->where('sale_id', $value->id)
            ->get();
            $FormasDePago->each(function($item, $key){
                $this->FormasDePago->push($item);
            });
        }
        foreach ($this->FormasDePago as $key => $value) {
            $FormasDePago = collect();
            if($this->FormasDePago->where('tipo', 'Yape')->first())
            {
                $valor = $this->FormasDePago->where('tipo', 'Yape')->sum('valor');
                $tipo = 'Yape';
                $objeto = [
                    'tipo' => $tipo,
                    'valor'=> $valor
                ];
                $FormasDePago->push($objeto);
            }
            if($this->FormasDePago->where('tipo', 'Plim')->first())
            {
                $valor = $this->FormasDePago->where('tipo', 'Plim')->sum('valor');
                $tipo = 'Plim';
                $objeto = [
                    'tipo' => $tipo,
                    'valor'=> $valor
                ];
                $FormasDePago->push($objeto);
            }
            if($this->FormasDePago->where('tipo', 'Transferencia')->first())
            {
                $valor = $this->FormasDePago->where('tipo', 'Transferencia')->sum('valor');
                $tipo = 'Transferencia';
                $objeto = [
                    'tipo' => $tipo,
                    'valor'=> $valor
                ];
                $FormasDePago->push($objeto);
            }
            if($this->FormasDePago->where('tipo', 'Tarjeta')->first())
            {
                $valor = $this->FormasDePago->where('tipo', 'Tarjeta')->sum('valor');
                $tipo = 'Tarjeta';
                $objeto = [
                    'tipo' => $tipo,
                    'valor'=> $valor
                ];
                $FormasDePago->push($objeto);
            }
            if($this->FormasDePago->where('tipo', 'Efectivo')->first())
            {
                $valor = $this->FormasDePago->where('tipo', 'Efectivo')->sum('valor');
                $tipo = 'Efectivo';
                $objeto = [
                    'tipo' => $tipo,
                    'valor'=> $valor
                ];
                $FormasDePago->push($objeto);
            }
            $this->FormasDePago = $FormasDePago;
        }
        $this->total = $this->sales ? $this->sales->sum('total') : 0;
        $this->items = $this->sales ? $this->sales->sum('items') : 0;
    }

    public function viewDetails(Sale $sale)
    {
        $fi=Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $ff=Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';
        $this->details = Sale::join('sale_details as d', 'd.sale_id', 'sales.id')
        ->join('products as p', 'p.id', 'd.product_id')
        ->select('d.sale_id', 'p.name as product', 'd.quantity', 'd.price')
        ->whereBetween('sales.created_at', [$fi, $ff])
        ->where('sales.status', 'Paid')
        ->where('sales.user_id', $this->userid)
        ->where('sales.id', $sale->id)
        ->get();
        $this->emit('show-modal', 'open modal');
    }

    public function Print()
    {
        
    }
}
