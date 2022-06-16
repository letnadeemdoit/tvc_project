<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'audit_schedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Audit_Sequence',
        'Audit_Timestamp',
        'Audit_Type',
        'ScheduleId',
        'OwnerId',
        'DateId',
        'HouseId',
        'RoomId',
        'GuestId',
        'VacationId',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];

}
