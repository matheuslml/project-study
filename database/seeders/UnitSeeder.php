<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'name' => 'Guarda Municipal de Arraial do Cabo',
            'sigla' => 'GMAC',
            'city_id' => 3570,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
