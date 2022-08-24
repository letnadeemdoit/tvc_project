<?php

namespace App\Models\Room;

use App\Models\AmenityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'Room';

    protected $primaryKey = 'RoomID';

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
    ];


    public function roomType() {
        return $this->belongsTo(RoomType::class, 'RoomTypeID', 'RoomTypeID');
    }

    public function amenities() {
        return $this->belongsToMany(AmenityType::class, RoomAmenity::class, 'RoomID', 'AmenityID');
    }
}
