<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogViews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address'
    ];

    public function viewable()
    {
        return $this->morphTo();
    }

}
