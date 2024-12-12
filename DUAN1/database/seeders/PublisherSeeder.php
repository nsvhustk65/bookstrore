<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 5; $i++) {
            DB::table('publishers')->insert([
                'name'=> fake()->text(15),
                'address'=> fake()->address(),
                'phone'=> fake()->phoneNumber(),
            ]);
        }
    }
}
