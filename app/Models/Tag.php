<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function blogs()
    {
        return $this->belongsToMany(Tag::class, 'tag_blogs', 'blog_id', 'tag_id');
    }
}
