<?php

namespace App\Models\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'user_id',
        'parent_id',
        'image',
        'name',
        'description',
    ];

    public function parentAlbum() {
        return $this->belongsTo(Album::class, 'parent_id');
    }

    public function nestedAlbums() {
        return $this->hasMany(Album::class, 'parent_id');
    }

}
