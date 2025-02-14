<?php

namespace App\Models;

use App\Models\Room\Room;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationRoom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'vacation_id',
        'occupant_name',
        'room_id',
        'starts_at',
        'ends_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id', 'RoomID');
    }

    public function vacation(){
        return $this->belongsTo(Vacation::class, 'vacation_id', 'VacationId');
    }

    public function toCalendar()
    {
        // I use this solution because rooms overlap the vacation on calendar
        $endsAtMinus10Minutes = (clone $this->ends_at)->sub(new DateInterval('PT10M'));

        return array_merge([
            'id' => $this->vacation_id,
            'occupant_name' => $this->occupant_name,
            'room_id' => $this->room_id,
            'vacation_room_id' => $this->id,
            'title' => $this->room->RoomName . ' '. '('.$this->occupant_name.')',
            'start' => str_replace(' ', 'T', $this->starts_at->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $endsAtMinus10Minutes->format('Y-m-d H:i:s')),
//            'end' => str_replace(' ', 'T', $this->ends_at->format('Y-m-d H:i:s')),
            'allDay' => false,
            'display' => 'block',
            'className' => 'fullcalendar-custom-event-hs-team',
            'backgroundColor' => $this->vacation->BackGrndColor,
            'textColor' => $this->vacation->FontColor,
            'resourceId' => $this->room_id,
            'imageUrl' => $this->vacation->owner ? $this->vacation->owner->profile_photo_url : null,
            'parent_id' => $this->vacation->parent_id,
            'vacation_owner_id' => $this->vacation->OwnerId,
            'is_room' => true,
        ], []);
    }

    public function houseVacationRooms()
    {
        $endsAtMinus10Minutes = (clone $this->ends_at)->sub(new DateInterval('PT10M'));

        return array_merge([
            'id' => $this->vacation_id,
            'occupant_name' => $this->occupant_name,
            'room_id' => $this->room_id,
            'vacation_room_id' => $this->id,
            'title' => $this->room->RoomName . ' '. '('.$this->occupant_name.')',
            'start' => str_replace(' ', 'T', $this->starts_at->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $endsAtMinus10Minutes->format('Y-m-d H:i:s')),
            'imageUrl' => $this->vacation->owner ? $this->vacation->owner->profile_photo_url : null,
            'parent_id' => $this->vacation->parent_id,
            'vacation_owner_id' => $this->vacation->OwnerId,
            'is_room' => true,
        ], []);
    }

}
