<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Calendar extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /**
     * @var string
     */
    protected $table = 'Calendar';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'DateId';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Year',
        'Month',
        'Day',
        'RealDate',
    ];

}
