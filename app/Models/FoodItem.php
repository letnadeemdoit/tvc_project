<?php

namespace App\Models;

use App\Models\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodItem extends Model implements Auditable
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
        'user_id',
        'house_id',
        'name',
        'location',
        'expiration_date',
        'image',
        'description',
    ];

    protected function defaultFileUrl($column = 'image')
    {
//        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
//            return mb_substr($segment, 0, 1);
//        })->join(' '));
//
//        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        return '/images/house-items/default.svg';
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
        'user_id',
        'house_id',
        'description',
        'published',
    ];
}
