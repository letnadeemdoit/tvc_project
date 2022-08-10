<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

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
        'OwnerId'
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
        $startDateTime = $this->getStartDatetimeAttribute()->format('m/d/Y h:i');
        $endDateTime = $this->getEndDatetimeAttribute()->format('m/d/Y h:i');

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
}
