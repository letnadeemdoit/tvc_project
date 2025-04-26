<?php

namespace App\Models\Photo;

use App\Models\Blog\Blog;
use App\Models\House;
use App\Models\Traits\HasFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Album extends Model implements Auditable
{
    use HasFactory;
    use HasFile;
    use AuditableTrait;

    protected bool $generateThumbnail = true;

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

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function getRelevantPhotos($albumId,$userHouseId)
    {
        return Photo::where('album_id',$albumId)->where('HouseId', $userHouseId)->get();
    }

    protected function defaultFileUrl($column = 'image')
    {
        $photo = $this->photos()->inRandomOrder()->first();
    
        if ($photo && ($photo->path != null && $photo->HouseId == auth()->user()->HouseId)) {
            return $photo->getFileUrl('path');
        }
    
        $nestedAlbum = $this->nestedAlbums()->first();
        if ($nestedAlbum && ($nestedAlbum->image != null && $nestedAlbum->house_id == auth()->user()->HouseId)) {
            return $nestedAlbum->getFileUrl();
        }
    
        return asset("images/photo-album/vacation-calendar.png");
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id',
        'house_id',
        'user_id',
        'description',
        'published',
    ];



}
