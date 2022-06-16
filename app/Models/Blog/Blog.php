<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'BlogId',
        'HouseId',
        'Subject',
        'Content',
        'Author',
        'BlogDate',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];


}
