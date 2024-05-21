<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Denomination;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(DenominationSeeder::class);
        $this->call(CategorySeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(Permisos::class);
        // $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        
    }
}
