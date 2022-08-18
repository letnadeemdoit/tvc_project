<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class BlogComment extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'BlogComment';
    protected $primaryKey = 'CommentId';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'BlogId',
        'CommentId',
        'Author',
        'Content',
        'BlogDate',
        'HouseId',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];
}
