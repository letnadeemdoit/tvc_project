<?php

namespace App\Rules;

use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class VacationSchedule implements Rule
{
    private $endDatetime;
    private $startDatetime;
    private $user;
    private $vacation;

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
    public function __construct($endDatetime, $user, $vacation)
    {
        try {
            $this->endDatetime = Carbon::parse($endDatetime);
        } catch (\Exception $e) {
            $this->endDatetime = 'invalid';
        }

        $this->user = $user;
        $this->vacation = $vacation;
    }

    private function isEndDateGreaterThanStartDate()
    {
        return date("Ymd", mktime(0, 0, 0, $this->startDatetime->month, $this->startDatetime->day, $this->startDatetime->year)) > date("Ymd", mktime(0, 0, 0, $this->endDatetime->month, $this->endDatetime->day, $this->endDatetime->year));
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
        if (is_null($this->endDatetime) || $this->endDatetime === 'invalid') return false;

        try {
            $this->startDatetime = Carbon::parse($value);
        } catch (\Exception $e) {
            $this->startDatetime = 'invalid';
            return false;
        }

        if ($this->isEndDateGreaterThanStartDate()){
            return false;
        }

        return !(count(\DB::select(
                "SELECT C.RealDate, C.DateId
 		            FROM Calendar C, Calendar CE, Vacations V, Time T, Time TE
 		            WHERE
 		                C.DateId = V.StartDateId
                        AND CE.DateId = V.EndDateId
                        AND T.timeid = V.StartTimeId
                        AND TE.timeid = V.EndTimeId
                        AND ((CONCAT_WS(' ', C.RealDate, T.time) <= STR_TO_DATE('" . $value . "', '%m/%d/%Y %H:%i')
                              AND CONCAT_WS(' ', CE.RealDate,TE.time) >= STR_TO_DATE('" . $value . "', '%m/%d/%Y %H:%i'))
                          OR
                          (CONCAT_WS(' ', C.RealDate,T.time) >= STR_TO_DATE('" . $value . "', '%m/%d/%Y %H:%i')
                              AND CONCAT_WS(' ', CE.RealDate,TE.time) <= STR_TO_DATE('" . $this->endDatetime->format('m/d/Y H:i') . "', '%m/%d/%Y %H:%i'))
                          OR
                          (CONCAT_WS(' ', C.RealDate,T.time) >= STR_TO_DATE('" . $value . "', '%m/%d/%Y %H:%i')
                              AND CONCAT_WS(' ', C.RealDate,T.time) <= STR_TO_DATE('" . $this->endDatetime->format('m/d/Y H:i') . "', '%m/%d/%Y %H:%i'))
                        )
                        AND V.HouseId = " . $this->user->HouseId . (
                           !is_null($this->vacation->VacationId) ? " AND V.VacationId <> " . $this->vacation->VacationId : ''
                        )
            )) > 0);
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public
    function message()
    {
        if ($this->message) {
            return $this->message;
        }

        switch (true) {
            case $this->startDatetime === 'invalid':
                return "The start datetime is invalid.";
            case $this->isEndDateGreaterThanStartDate():
                return "Start date must be before end date.";
            case is_null($this->endDatetime):
                return "The end datetime field is required.";
            case $this->endDatetime === 'invalid':
                return "The end datetime is invalid.";
            default:
                return "Another vacation conflicts with your dates.";
        }
    }

    /**
     * Set the message that should be used when the rule fails.
     *
     * @param string $message
     * @return $this
     */
    public
    function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
