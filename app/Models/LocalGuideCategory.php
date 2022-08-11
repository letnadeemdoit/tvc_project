<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGuideCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function LocalGuide()
    {
        return $this->hasMany(LocalGuide::class);
    }

}
