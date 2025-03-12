<?php

namespace App\Models;

use App\Models\Blog\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasFile;

use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Category extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use HasFile;

    /**
     * @const string
     */
    const TYPE_BLOG = 'blog';
    /**
     * @const string
     */
    const TYPE_BULLETIN_BOARD = 'bulletin-board';
    /**
     * @const string
     */
    const TYPE_LOCAL_GUIDE = 'local-guide';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'house_id',
        'image',
        'name',
        'slug',
        'description',
        'type'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeBlog($query)
    {
        return $query->where('type', self::TYPE_BLOG);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeBulletinBoard($query)
    {
        return $query->where('type', self::TYPE_BULLETIN_BOARD);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLocalGuide($query)
    {
        return $query->where('type', self::TYPE_LOCAL_GUIDE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bulletinBoards()
    {
        return $this->hasMany(Board::class);
    }

    public function localGuides()
    {
        return $this->hasMany(LocalGuide::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    protected function defaultFileUrl($column = 'image'): string
    {
        $name = trim(collect(explode(' ', $this->Subject))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }

    protected $auditExclude = [
        'id',
        'user_id',
        'house_id',
        'description',
        'published',
    ];

}
