<?php

namespace Database\Seeders;

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
         $this->call(CountrySeeder::class);
         $this->call(StateSeeder::class);
         $this->call(CitySeeder::class);
         $this->call(PersonSeeder::class);
         $this->call(DisciplineSeeder::class);
         $this->call(LessonSeeder::class);
         $this->call(ExerciseSeeder::class);
         $this->call(DisciplinePersonSeeder::class);
         //$this->call(UserSeeder::class);
    }
}
