<?php

namespace App\Models;

use App\Models\Room\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Vacation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /**
     * @var string
     */
    protected $table = 'Vacations';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'VacationId';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'VacationName',
        'BackGrndColor',
        'FontColor',
        'StartDateId',
        'EndDateId',
        'StartTimeId',
        'EndTimeId',
        'OwnerId',
        'HouseId',
        'AllowOwners',
        'AllowGuests',
        'Completed',
        'recurrence',
        'repeat_interval',
        'parent_id',
        'book_rooms',
        'is_vac_approved',
        'is_calendar_task',
        'EndRepeatDateId',
        'original_owner',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'book_rooms' => 'boolean',
    ];

    /**
     * Get start date from calendar
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startDate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Calendar::class, 'StartDateId', 'DateId');
    }

    /**
     * Get end date from calendar
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endDate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Calendar::class, 'EndDateId', 'DateId');
    }

    /**
     * Get start time from time
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function startTime(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Time::class, 'StartTimeId', 'timeid');
    }

    /**
     *  Get end time from time
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endTime(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Time::class, 'EndTimeId', 'timeid');
    }

    /**
     * @return Carbon
     */
    public function getStartDatetimeAttribute(): Carbon
    {
        $startDate = $this->startDate->RealDate;
        $startTime = $this->startTime->time;

        return Carbon::parse("$startDate $startTime");
    }

    /**
     * @return Carbon
     */
    public function getEndDatetimeAttribute(): Carbon
    {
        $endDate = $this->endDate->RealDate;
        $endTime = $this->endTime->time;

        return Carbon::parse("$endDate $endTime");
    }

    /**
     * @return string
     */
    public function getScheduledDatesAttribute(): string
    {
        $startDateTime = $this->getStartDatetimeAttribute()->format('m/d/Y H:i');
        $endDateTime = $this->getEndDatetimeAttribute()->format('m/d/Y H:i');

        return "Scheduled from $startDateTime to $endDateTime";
    }

    /**
     * Background color mutation
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function BackGrndColor(): Attribute
    {
        return Attribute::make(
            get: fn($value) => '#' . ltrim($value, '#'),
            set: fn($value) => ltrim($value, '#'),
        );
    }

    /**
     * Foreground or font color mutation
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function FontColor(): Attribute
    {
        return Attribute::make(
            get: fn($value) => '#' . ltrim($value, '#'),
            set: fn($value) => ltrim($value, '#'),
        );
    }

    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedule::class, 'VacationID', 'VacationId');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'OwnerId', 'user_id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }

    public function toCalendar()
    {

        return array_merge([
            'id' => $this->VacationId,
            'OwnerId' => $this->OwnerId,
            'title' => $this->VacationName,
            'start' => str_replace(' ', 'T', $this->start_datetime->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $this->end_datetime->format('Y-m-d H:i:s')),
            'allDay' => false,
            'display' => 'block',
            'className' => 'fullcalendar-custom-event-hs-team',
            'backgroundColor' => optional(User::where('user_id', $this->OwnerId)->first())->role === 'Owner' && $this->is_vac_approved === 0 ? '#CCCCCC' : $this->BackGrndColor,
            'textColor' => $this->FontColor,
            'resourceIds' => [00],
            'imageUrl' => $this->owner ? $this->owner->profile_photo_url : null,
            'parent_id' => $this->parent_id,
            'is_room' => false,
            'user_role' => optional(User::where('user_id', $this->OwnerId)->first())->role,
            'is_calendar_task' => $this->is_calendar_task,
        ], []);
    }


    public function approvalVacations()
    {

        return array_merge([
            'id' => $this->VacationId,
            'OwnerId' => $this->OwnerId,
            'VacationName' => $this->VacationName,
            'start' => str_replace(' ', 'T', $this->start_datetime->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $this->end_datetime->format('Y-m-d H:i:s')),
            'is_vac_approved' => $this->is_vac_approved,
            'user_role' => optional(User::where('user_id', $this->OwnerId)->first())->role,
            'created_by' => optional(User::where('user_id', $this->OwnerId)->first())->first_name . ' ' . optional(User::where('user_id', $this->OwnerId)->first())->last_name,
            'house_name' => optional(House::where('HouseID', primary_user()->HouseId)->first())->HouseName,
        ], []);
    }



    public function toAppCalendar()
    {

        return array_merge([
            'id' => $this->VacationId,
            'OwnerId' => $this->OwnerId,
            'title' => $this->VacationName,
            'start' => str_replace(' ', 'T', $this->start_datetime->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $this->end_datetime->format('Y-m-d H:i:s')),
            'allDay' => false,
            'display' => 'block',
            'className' => 'fullcalendar-custom-event-hs-team',
            'backgroundColor' => optional(User::where('user_id', $this->OwnerId)->first())->role === 'Owner' && $this->is_vac_approved === 0 ? '#CCCCCC' : $this->BackGrndColor,
            'textColor' => $this->FontColor,
            'resourceIds' => [00],
            'imageUrl' => $this->owner ? $this->owner->profile_photo_url : null,
            'parent_id' => $this->parent_id,
            'is_room' => false,
            'user_role' => optional(User::where('user_id', $this->OwnerId)->first())->role,
            'is_calendar_task' => $this->is_calendar_task,
            'book_rooms' => $this->book_rooms,
            'recurrence' => $this->recurrence,
            'repeat_interval' => $this->repeat_interval,
        ], []);
    }

    public function houseVacations()
    {
        return array_merge([
            'VacationID' => $this->VacationId,
            'VacationName' => $this->VacationName,
            'start_date' => str_replace(' ', 'T', $this->start_datetime->format('Y-m-d H:i:s')),
            'end_date' => str_replace(' ', 'T', $this->end_datetime->format('Y-m-d H:i:s')),
            'is_calendar_task' => $this->is_calendar_task,
            'book_rooms' => $this->book_rooms,
            'is_room' => false,
        ], []);
    }


    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'BackGrndColor',
        'FontColor',
        'DateId',
//        'EndDateId',
//        'StartTimeId',
//        'EndTimeId',
        'OwnerId',
        'HouseId',
//        'AllowOwners',
//        'AllowGuests',
//        'Completed'
    ];


    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if (Arr::has($data, 'new_values.StartDateId')) {
            $data['old_values']['start date'] = optional(Calendar::where('DateId', $this->getOriginal('StartDateId'))->first())->RealDate;
            $data['new_values']['start date'] = $this->startDate->RealDate;

            unset($data['old_values']['StartDateId']);
            unset($data['new_values']['StartDateId']);
        }

        if (Arr::has($data, 'new_values.EndDateId')) {
            $data['old_values']['end date'] = optional(Calendar::where('DateId', $this->getOriginal('EndDateId'))->first())->RealDate;
            $data['new_values']['end date'] = $this->endDate->RealDate;

            unset($data['old_values']['EndDateId']);
            unset($data['new_values']['EndDateId']);
        }

        if (Arr::has($data, 'new_values.StartTimeId')) {
            $data['old_values']['start time'] = optional(Time::where('timeid', $this->getOriginal('StartTimeId'))->first())->time;
            $data['new_values']['start time'] = $this->startTime->time;

            unset($data['old_values']['StartDateId']);
            unset($data['new_values']['StartDateId']);
        }

        if (Arr::has($data, 'new_values.EndTimeId')) {
            $data['old_values']['end time'] = optional(Time::where('timeid', $this->getOriginal('EndTimeId'))->first())->time;
            $data['new_values']['end time'] = $this->endTime->time;

            unset($data['old_values']['EndDateId']);
            unset($data['new_values']['EndDateId']);
        }

        return $data;
    }

    public function rooms() {
        return $this->hasMany(VacationRoom::class, 'vacation_id', 'VacationId');
    }

    public function recurrings()
    {
        return $this->hasMany(Vacation::class, 'parent_id', 'VacationId');
    }
}
