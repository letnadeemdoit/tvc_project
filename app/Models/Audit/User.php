<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'audit_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Audit_Sequence',
        'Audit_Timestamp',
        'Audit_Type',
        'user_id',
        'user_name',
        'first_name',
        'last_name',
        'password',
        'email',
        'remote_addr',
        'confirm_hash',
        'is_confirmed',
        'role',
        'OwnerId',
        'date_created',
        'HouseId',
        'Intro',
        'AdminOwner',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];

}
