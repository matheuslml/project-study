<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->insert([
            'departament_id' => 1,
            'title' => 'Administrador',
            'slug' => 'administrador',
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
