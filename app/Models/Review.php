<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_id',
        'commentable_type',
        'commentable_type',
        'rating',
        'remarks',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
