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


    protected function defaultFileUrl($column = 'image')
    {
        $photo = $this->photos()->inRandomOrder()->first();

        if (!$photo) {
            $nestedAlbum = $this->nestedAlbums()->first();
            if ($nestedAlbum) {
                return $nestedAlbum->getFileUrl();
            }
        } else {
            return $photo->getFileUrl('path');
        }

        return 'https://images.unsplash.com/photo-1661688625912-8d0191156923?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60';
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'house_id');
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
