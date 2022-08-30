<?php

namespace App\Models\Blog;

use App\Models\BlogViews;
use App\Models\Category;
use App\Models\Comment;
use App\Models\House;
use App\Models\Likes;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasFile;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Blog extends Model implements Auditable
{
    use HasFactory;
    use HasFile;
    use AuditableTrait;

    /**
     * @var string
     */
    protected $table = 'Blog';

    /**
     * @var string
     */
    protected $primaryKey = 'BlogId';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'BlogId',
        'HouseId',
        'user_id',
        'Subject',
        'Contents',
        'Content',
        'Author',
        'BlogDate',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
        'image',
        'slug',
        'category_id'
    ];

    protected $auditExclude = [
        'Content',
        'Contents'
    ];


    /**
     * @param $column
     * @return string
     */
    protected function defaultFileUrl($column = 'image'): string
    {
//        $name = trim(collect(explode(' ', $this->Subject))->map(function ($segment) {
//            return mb_substr($segment, 0, 1);
//        })->join(' '));
//
//        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
        return '/images/blog-images/single.png';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function house(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }

    public function likes()
    {
        return $this->morphMany(Likes::class, 'likeable');
    }

    public function views()
    {
        return $this->morphMany(BlogViews::class, 'viewable');
    }
}
