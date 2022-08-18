<?php

namespace App\Models;

use App\Models\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class LocalGuide extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use HasFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'local_guide_category_id',
        'user_id',
        'house_id',
        'title',
        'description',
        'image',
        'address',
        'datetime',
    ];

    protected $attributeModifiers = [

    ];


//    public function transformAudit(array $data): array
//    {
//        Arr::set($data, 'auditable_table',  $this->getTable());
//        Arr::set($data, 'version',  $this->version);
//
//        return $data;
//    }


    protected function defaultFileUrl($column = 'image')
    {
        $name = trim(collect(explode(' ', $this->title))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }


    public function localGuideCategory()
    {
        return $this->belongsTo(LocalGuideCategory::class);
    }


    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'house_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'commentable');
    }

}

