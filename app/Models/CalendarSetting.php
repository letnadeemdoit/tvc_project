<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarSetting extends Model
{
    use HasFactory;

    protected $table = 'calendar_settings';

    protected $fillable = [
        'user_id',
        'house_id',
        'enable_schedule_window',
        'StartDateId',
        'EndDateId',
        'owner_vacation_approval',
        'StartTimeId',
        'EndTimeId',
        'calendar_style',
        'calendar_height',
        'vacation_length',
        'overlap_vacation',
        'allow_guest_vacations',
        'allow_informational_entries',
        'enable_max_vacation_length',
        'enable_calendar_access'
    ];


    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseId');
    }

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
        $startDate = $this->startDate->RealDate ?? null;
        $startTime = $this->startTime->time;

        return Carbon::parse("$startDate $startTime");
    }

    /**
     * @return Carbon
     */
    public function getEndDatetimeAttribute(): Carbon
    {
        $endDate = $this->endDate->RealDate ?? null;
        $endTime = $this->endTime->time;

        return Carbon::parse("$endDate $endTime");
    }


    public function toCalendarSettings()
    {

        return array_merge([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'house_id' => $this->house_id,
            'start_date' => $this->startDate ? str_replace(' ', 'T', $this->startDate->RealDate) : null,
            'end_date' => $this->endDate ? str_replace(' ', 'T', $this->endDate->RealDate) : null,
            'start_time' => $this->startTime ? str_replace(' ', 'T', $this->startTime->time) : null,
            'end_time' => $this->endTime ? str_replace(' ', 'T', $this->endTime->time) : null,
            'enable_schedule_window' => $this->enable_schedule_window,
            'owner_vacation_approval' => $this->owner_vacation_approval,
            'calendar_style' => $this->calendar_style,
            'calendar_height' => $this->calendar_height,
            'enable_max_vacation_length' => $this->enable_max_vacation_length,
            'vacation_length' => $this->vacation_length,
            'overlap_vacation' => $this->overlap_vacation,
            'allow_guest_vacations' => $this->allow_guest_vacations,
            'allow_informational_entries' => $this->allow_informational_entries,
            'enable_calendar_access' => $this->enable_calendar_access,
        ], []);
    }



}
