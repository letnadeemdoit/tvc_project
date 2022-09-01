<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'Completed'
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
            get: fn ($value) => '#' . ltrim($value, '#'),
            set: fn ($value) => ltrim($value, '#'),
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
            get: fn ($value) => '#' . ltrim($value, '#'),
            set: fn ($value) => ltrim($value, '#'),
        );
    }

    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedule::class, 'VacationId', 'VacationID');
    }

    public function toCalendar() {
        return [
            'id' => $this->VacationId,
            'title' => $this->VacationName,
            'start' => str_replace(' ', 'T', $this->start_datetime->format('Y-m-d H:i:s')),
            'end' => str_replace(' ', 'T', $this->end_datetime->format('Y-m-d H:i:s')),
            'allDay' => false,
            'color' => $this->back_grnd_color,
            'textColor' => $this->font_color,
            'className' => 'way',
            'resourceIds' => $this->schedules->pluck('RoomId')->toArray()
        ];
    }
}
