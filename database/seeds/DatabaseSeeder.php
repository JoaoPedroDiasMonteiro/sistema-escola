<?php

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
        // $this->call(UserSeeder::class);
     $this->call(TestSeeder::class);
//        $teachers = factory(\App\Teacher::class, 10)->make()->toArray();
//
//        \Illuminate\Support\Facades\DB::table('teachers')->insert($teachers);
    }
}
