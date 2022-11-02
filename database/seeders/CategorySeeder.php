<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'user_id' => null,
                'image' => null ,
                'name' => 'Food & Drink',
                'slug' => 'food-&-Drink',
                'description' => null,
                'type' => 'local-guide',
            ],
            [
                'user_id' => null,
                'image' => null ,
                'name' => 'Things to Do',
                'slug' => 'things-to-Do',
                'description' => null,
                'type' => 'local-guide',
            ],
            [
                'user_id' => null,
                'image' => null ,
                'name' => 'Services',
                'slug' => 'services',
                'description' => null,
                'type' => 'local-guide',
            ],
            [
                'user_id' => null,
                'image' => null ,
                'name' => 'Transportation',
                'slug' => 'transportation',
                'description' => null,
                'type' => 'local-guide',
            ],

        ]);
    }
}
