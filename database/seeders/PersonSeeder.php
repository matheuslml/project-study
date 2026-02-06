<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $filePath = database_path('seeders/raw/people.sql');
        if(File::exists($filePath)){
            DB::unprepared(file_get_contents($filePath));
            $this->command->info('People Table Seed');
        }
    }
}