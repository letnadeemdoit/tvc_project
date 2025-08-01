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
        'category_id',
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
//        $name = trim(collect(explode(' ', $this->title))->map(function ($segment) {
//            return mb_substr($segment, 0, 1);
//        })->join(' '));

//        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        return '/images/local-guide/default.png';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function likes()
    {
        return $this->morphMany(Likes::class, 'likeable');
    }

    public function views()
    {
        return $this->morphMany(BlogViews::class, 'viewable');
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



    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id',
        'user_id',
        'house_id',
//        'category_id',
        'published',
        'description',
    ];



    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if (Arr::has($data, 'new_values.category_id')) {

//            $data['old_values']['category name'] = Category::find($this->getOriginal('category_id'));
            $data['old_values']['category name'] = optional(Category::where('id', $this->getOriginal('category_id'))->first())->RealDate;

            $data['new_values']['category name'] = $this->category->name;

            unset($data['old_values']['category_id']);
            unset($data['new_values']['category_id']);

        }
        return $data;
    }

}

