<?php

namespace App\Models\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Photo';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $primaryKey = 'PhotoId';

    protected $fillable = [
        'HouseId',
        'album_id',
        'description',
    ];

    public function getImageAttribute()
    {

        $path = "photos/photo_{$this->HouseId}_{$this->PhotoId}.jpg";

        if (\Storage::disk('public')->exists($path)) {
            return \Storage::disk('public')->url($path);
        }

        return null;
    }

//    $this->file->storeAs('photos', "photo_{$HouseId}_{$PhotoId}.jpg", 'public');

}
