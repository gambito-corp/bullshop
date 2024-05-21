<?php

namespace Database\Seeders;

use App\Models\Denomination;
use Illuminate\Database\Seeder;

class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 200
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 100
        ]);
        
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 50
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 20
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 10
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 5
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 1
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 2
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 0.5
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 0.2
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 0.1
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 0.05
        ]);
        Denomination::create([
            'type' => 'MONEDA',
            'value' => 0.01
        ]);
        Denomination::create([
            'type' => 'YAPE',
            'value' => 0
        ]);
        Denomination::create([
            'type' => 'TRANSFERENCIA',
            'value' => 0
        ]);
        Denomination::create([
            'type' => 'TARJETA',
            'value' => 0
        ]);
        Denomination::create([
            'type' => 'OTRO',
            'value' => 0
        ]);
    }
}
