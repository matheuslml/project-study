<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departaments')->insert([
            'departament' => 'Corporação',
            'sigla' => 'COP',
            'code' => 001,
            'unit_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
