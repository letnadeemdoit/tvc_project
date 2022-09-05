<?php

namespace App\Models;

use App\Models\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Arr;
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
        'category_id'
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

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $auditExclude = [
        'id',
        'HouseId',
        'Board',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];

    /**
     * {@inheritdoc}
     */
//    public function transformAudit(array $data): array
//    {
//
//        if (Arr::has($data, 'new_values.category_id')) {
//
//            $data['old_values']['category name'] = Category::find($this->getOriginal('category_id'));
//
//            $data['new_values']['category name'] = $this->category->name;
//
//        }
//
//        return $data;
//    }

}
