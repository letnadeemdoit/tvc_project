<?php

namespace App\Models;

use App\Models\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGuide extends Model
{
    use HasFactory;

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

}

