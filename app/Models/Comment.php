<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Comment extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;


    protected $fillable = [
        'user_id',
        'house_id',
        'commentable_type',
        'commentable_type',
        'message',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
