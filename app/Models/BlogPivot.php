<?php

namespace App\Models;

use App\Models\Blog\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPivot extends Model
{
    use HasFactory;


    protected $fillable = [
        'blog_id',
        'tag_id',
    ];

    public function pivot() {
        return $this->belongsTo(Blog::class);
    }
}
