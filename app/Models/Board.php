<?php

namespace App\Models;

use App\Models\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class Board extends Model  implements Auditable
{
    use HasFile;
    use HasFactory;
    use AuditableTrait;

    protected $table = 'Board';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'HouseId',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
        'title',
        'image',
        'Board',
    ];

    /**
     * Get the default file URL if no file has been uploaded.
     *
     * @return string
     */
    protected function defaultFileUrl($column = 'image')
    {
        $name = trim(collect(explode(' ', $this->title))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }

}
