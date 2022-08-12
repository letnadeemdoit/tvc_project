<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request) {
        return view('blog.index', [
            'user' => $request->user()
        ]);
    }

    public function show(Request $request, Blog $post) {
        return view('blog.post', [
            'user' => $request->user(),
            'post' => $post
        ]);
    }
}
