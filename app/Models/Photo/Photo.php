<?php

namespace App\Models\Photo;

use App\Models\House;
use App\Models\Traits\HasFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Photo extends Model implements Auditable
{
    use HasFactory;
    use HasFile;
    use AuditableTrait;


    protected $table = 'Photo';

    protected $generateThumbnail = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $primaryKey = 'PhotoId';

    protected $fillable = [
        'HouseId',
        'album_id',
        'OwnerId',
        'sort_order',
        'description',
        'path',
    ];

    /**
     * Get the URL to the file.
     *
     * @return string
     */
    public function getFileUrl($column = 'path')
    {

        $photoPath = "photos/photo_".$this->HouseId."_".$this->PhotoId.".jpg";
        if (Storage::disk($this->fileDisk())->exists($photoPath)) {
            $this->{$column} = "photos/photo_".$this->HouseId."_".$this->PhotoId.".jpg";
        }

        return $this->{$column}
            ? Storage::disk($this->fileDisk())->url($this->{$column})
            : $this->defaultFileUrl($column);
    }

    public function getImageAttribute()
    {

        $path = "photos/photo_{$this->HouseId}_{$this->PhotoId}.jpg";

        if (\Storage::disk('public')->exists($path)) {
            return \Storage::disk('public')->url($path);
        }

        return null;
    }

    public function album() {
        return $this->belongsTo(Album::class);
    }

    protected function defaultFileUrl($column = 'image')
    {
//        $name = trim(collect(explode(' ', $this->house ? $this->house->HouseName : ''))->map(function ($segment) {
//            return mb_substr($segment, 0, 1);
//        })->join(' '));

//        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        return '/images/photo-album/album-detail.svg';
    }


    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
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
        'PhotoId',
        'HouseId',
        'album_id',
    ];

//    $this->file->storeAs('photos', "photo_{$HouseId}_{$PhotoId}.jpg", 'public');

}
