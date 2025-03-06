<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo\Album;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Food & Drink',
                'slug' => 'food-&-drink',
                'type' => 'local-guide',
            ],
            [
                'name' => 'Things to Do',
                'slug' => 'things-to-do',
                'type' => 'local-guide',
            ],
//            [
//                'name' => 'Services',
//                'slug' => 'services',
//                'type' => 'local-guide',
//            ],
//            [
//                'name' => 'Transportation',
//                'slug' => 'transportation',
//                'type' => 'local-guide',
//            ],
            [
                'name' => 'Vacation Summaries',
                'slug' => 'vacation-summaries',
                'type' => 'blog',
            ],
            [
                'name' => 'Blog',
                'slug' => 'blog',
                'type' => 'blog',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrInsert(
                ['slug' => $category['slug']], // Condition to check for existing record
                [
                    'user_id' => null,
                    'house_id' => null,
                    'image' => null,
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'description' => null,
                    'type' => $category['type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $albums = [
            [
                'name' => 'Activities'
            ]
        ];

        foreach ($albums as $album) {
            Album::updateOrInsert(
                ['name' => $album['name']], // Condition to check for existing record
                [
                    'user_id' => null,
                    'house_id' => null,
                    'parent_id' => null,
                    'image' => null,
                    'name' => $album['name'],
                    'description' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
