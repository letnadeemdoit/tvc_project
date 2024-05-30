<?php

namespace App\Rules;

use App\Models\CalendarSetting;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class VacationSchedule implements Rule
{
    /**
     * Start Datetime
     * @var Carbon|string
     */
    private $startDatetime;
    /**
     * End Datetime
     * @var Carbon|string
     */
    private $endDatetime;
    /**
     * @var User
     */
    private User $user;
    /**
     * Status to show message against validation failed
     *
     * @var string
     */
    private $status;
    /**
     * @var Vacation
     */
    private Vacation $vacation;

    /**
     * The message that should be used when validation fails.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($endDatetime, User $user, Vacation $vacation)
    {
        try {
            $this->endDatetime = Carbon::parse($endDatetime);
        } catch (\Exception $e) {
            $this->status = 'invalid-end-datetime';
        }

        $this->user = $user;
        $this->vacation = $vacation;
    }

    /**
     * Check is start date is greater or equal now
     * @return bool
     */
    public function isStartDatetimeGreaterOrEqualNow(): bool
    {
        return $this->startDatetime->gte(now());
    }

    /**
     * Check is end datetime greater than start datetime.
     * @return bool
     */
    private function isEndDateGreaterThanStartDate(): bool
    {
        return $this->endDatetime->gt($this->startDatetime);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->status === 'invalid-end-datetime') return false;

        try {
            $this->startDatetime = Carbon::parse($value);
        } catch (\Exception $e) {
            $this->status = 'invalid-start-datetime';
            return false;
        }

//        if (!$this->isStartDatetimeGreaterOrEqualNow() && $this->vacation && is_null($this->vacation->VacationId)) {
//            $this->status = 'start-datetime-must-be-greater-or-equal-from-now';
//            return false;
//        }

        if (!$this->isEndDateGreaterThanStartDate()) {
            $this->status = 'end-date-is-not-greater-than-start-date';
            return false;
        }


        //Vacation Overlapping Code
        $houseId = $this->user->HouseId;
        $existingVacation = Vacation::when($this->user->is_owner_only, function ($query) {
            $query->where('HouseId', $this->user->HouseId);
        })->when($this->user->is_guest, function ($query) {
            $query->where('HouseId', $this->user->HouseId);
        })
            ->whereIn('OwnerId', function ($query) use ($houseId) {
                $query->select('user_id')
                    ->from('users')
                    ->where('HouseId', $houseId)
                    ->whereIn('role', ['Owner', 'Guest']);
            })
            ->where('is_vac_approved', 0)
            ->where(function ($query) {
                $query->whereHas('startDate', function ($query) {
                    $query->whereDate('RealDate', '>=', Carbon::parse($this->startDatetime)->format('Y-m-d'))
                        ->whereDate('RealDate', '<=', Carbon::parse($this->endDatetime)->format('Y-m-d'));
                })
                    ->orWhereHas('endDate', function ($query) {
                        $query->whereDate('RealDate', '>=', Carbon::parse($this->startDatetime)->format('Y-m-d'))
                            ->whereDate('RealDate', '<=', Carbon::parse($this->endDatetime)->format('Y-m-d'));
                    });
            })
            ->first();

        $calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($calendarSettings && $calendarSettings->overlap_vacation === 'unapproved vacations' && $existingVacation && $existingVacation->VacationId){
            return true;
        }
        elseif ($calendarSettings && $calendarSettings->overlap_vacation === 'all vacations'){
            return true;
        }
        //End Vacation Overlapping Code


        $startDatetime = $this->startDatetime->format('m/d/Y H:i');
        $endDatetime = $this->endDatetime->format('m/d/Y H:i');
        $ignoredVacationId = $this->vacation->VacationId ?? -1;
        $results = DB::select("select is_vacation_already_scheduled({$this->user->HouseId}, '$startDatetime', '$endDatetime', $ignoredVacationId) as vacation_counts");

        return !(is_array($results) && count($results) > 0 && $results[0]->vacation_counts > 0);

    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        return match (true) {
            $this->status === 'invalid-start-datetime', $this->status === 'invalid-end-datetime' => "The start & end datetime is invalid.",
            $this->status === 'start-datetime-must-be-greater-or-equal-from-now' => "The start date must be equal or greater from now.",
            $this->status === 'end-date-is-not-greater-than-start-date' => "The start date must be before end date.",
            default => "Another vacation conflicts with your dates.",
        };
    }

    /**
     * Set the message that should be used when the rule fails.
     *
     * @param string $message
     * @return $this
     */
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }


}
