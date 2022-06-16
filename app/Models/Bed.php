<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $table = 'beds';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'RoomId',
        'ScheduleId',
        'GuestId',
        'BedId',
        'HouseId',
        'DateId',
        'BedNumber',
    ];
}
