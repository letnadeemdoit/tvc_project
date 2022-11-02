<?php

namespace Database\Seeders;

use App\Models\Room\BedType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BedType::firstOrCreate(['name' => 'King']);
        BedType::firstOrCreate(['name' => 'Queen']);
        BedType::firstOrCreate(['name' => 'Full']);
        BedType::firstOrCreate(['name' => 'Twin']);
        BedType::firstOrCreate(['name' => 'Bunk']);
    }
}
