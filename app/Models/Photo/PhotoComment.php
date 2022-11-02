<?php

namespace App\Models\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    use HasFactory;

    protected $table = 'PhotoComment';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $primaryKey = 'CommentId';

    protected $fillable = [
        'PhotoId',
        'HouseId',
        'Comment',
        'UserId',
        'CommentDate',
    ];

}
