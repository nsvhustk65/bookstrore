<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         for ($i = 0; $i < 5; $i++) {
            DB::table('categories')->insert([
                'name'=> fake()->text(15),
                'trang_thai'=> rand(0, 1),
                'mo_ta'=> fake()->text(150),
            ]);
        }
    }
}
