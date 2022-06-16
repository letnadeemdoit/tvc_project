<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'audit_house';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'Audit_Sequence',
        'Audit_Timestamp',
        'Audit_Type',
        'HouseID',
        'HouseName',
        'Address1',
        'Address2',
        'City',
        'State',
        'ZipCode',
        'HomePhone',
        'Fax',
        'EmergencyPhone',
        'Status',
        'Guest',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];


}
