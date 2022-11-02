<?php

namespace Database\Seeders;

use App\Models\LocalGuideCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalGuideCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LocalGuideCategory::insert([
            [
                'name' => 'Food & Drink',
            ],
            [
                'name' => 'Things to Do',
            ],
            [
                'name' => 'Services',
            ],
            [
                'name' => 'Transportation',
            ],

        ]);
    }
}
