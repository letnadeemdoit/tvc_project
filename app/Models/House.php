<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'House';

    protected $primaryKey = 'HouseID';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
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
        'ReferredBy',
        'Status',
        'Guest',
        'CalEmailList',
        'BlogEmailList',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'HouseId', 'HouseID');
    }
}
