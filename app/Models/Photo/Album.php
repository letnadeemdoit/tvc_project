<?php

namespace App\Models\Photo;

use App\Models\House;
use App\Models\Traits\HasFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    use HasFile;

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


    protected function defaultFileUrl($column = 'image')
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'house_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


}
