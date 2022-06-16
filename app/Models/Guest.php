<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guest';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'GuestId',
        'OwnerId',
        'FirstName',
        'LastName',
        'Email',
        'HouseGuest',
        'HouseId',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];
}
