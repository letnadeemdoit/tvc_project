<?php

namespace Database\Seeders;

use App\Models\Blog\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = Blog::where('BlogId', '<>', 138)->get();
        foreach ($blogs as $blog){
            $blog->update(['Contents' => $blog->Content]);
        }
    }
}
