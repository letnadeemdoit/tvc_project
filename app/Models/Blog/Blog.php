<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasFile;

class Blog extends Model
{
    use HasFactory;
    use HasFile;
    protected $table = 'Blog';
    protected $primaryKey = 'BlogId';
    public $timestamps = false;
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
        'BlogImage',
    ];


    protected function defaultFileUrl($column = 'BlogImage')
    {
        $name = trim(collect(explode(' ', $this->Subject))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

}
