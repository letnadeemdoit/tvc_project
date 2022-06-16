<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'audit_room';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Audit_Sequence',
        'Audit_Timestamp',
        'Audit_Type',
        'RoomID',
        'HouseID',
        'RoomTypeID',
        'RoomName',
        'Beds',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];
}
