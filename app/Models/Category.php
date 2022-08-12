<?php

namespace App\Models;

use App\Models\Blog\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
}
