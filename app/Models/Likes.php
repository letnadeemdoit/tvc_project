<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'blog_id',
        'likeable_type',
        'likeable_id',
        'likes',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }
}
