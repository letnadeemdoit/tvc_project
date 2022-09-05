<?php

namespace App\Models\Room;

use App\Models\AmenityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Laravel\Fortify\TwoFactorAuthenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Room extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'Room';

    protected $primaryKey = 'RoomID';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'RoomID',
        'HouseID',
        'RoomTypeID',
        'RoomName',
        'Beds',
        'HouseID'
    ];


    public function roomType() {
        return $this->belongsTo(RoomType::class, 'RoomTypeID', 'RoomTypeID');
    }

    public function amenities() {
        return $this->belongsToMany(AmenityType::class, RoomAmenity::class, 'RoomID', 'AmenityID');
    }

    public function toCalendarResource() {

        return [
            'id' => $this->RoomID,
            'title' => $this->RoomName,
        ];
    }


    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'RoomID',
        'HouseID'
    ];

}
