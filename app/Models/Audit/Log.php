<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'audit_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Audit_Sequence',
        'Audit_Timestamp',
        'Audit_LogLevel',
        'Audit_WebPage',
        'Audit_Comment',
        'Audit_HouseId',
        'Audit_user_name',
        'Audit_Role',
        'Audit_Query',
        'Audit_MySQL_Error',
    ];
}
