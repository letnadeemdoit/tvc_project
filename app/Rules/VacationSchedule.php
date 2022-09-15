<?php

namespace App\Rules;

use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

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

        if (!$this->isStartDatetimeGreaterOrEqualNow()) {
            $this->status = 'start-datetime-must-be-greater-or-equal-from-now';
            return false;
        }

        if (!$this->isEndDateGreaterThanStartDate()) {
            $this->status = 'end-date-is-not-greater-than-start-date';
            return false;
        }

        $vacationCounts = Vacation::where('HouseId', $this->user->HouseId)
            ->when(!is_null($this->vacation->VacationId), function ($query) {
                $query->where('VacationId', '<>', $this->vacation->VacationId);
            })
            ->where(function ($query) {
                $query
                    ->where(function ($query) {
                        $query
                            ->where('recurrence', 'once')
                            ->where(function ($query) {
                                $query
                                    ->where(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query->whereDate('RealDate', '<=', $this->startDatetime);
                                            })
                                            ->whereHas('endDate', function ($query) {
                                                $query->whereDate('RealDate', '>=', $this->startDatetime);
                                            })
                                            ->whereHas('startTime', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') <= DATE_FORMAT('" . $this->startDatetime->format('H:i') . "', '%H:%i')");
                                            })
                                            ->whereHas('endTime', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') >= DATE_FORMAT('" . $this->startDatetime->format('H:i') . "', '%H:%i')");
                                            });
                                    })
                                    ->orWhere(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query->whereDate('RealDate', '<=', $this->startDatetime);
                                            })
                                            ->whereHas('endDate', function ($query) {
                                                $query->whereDate('RealDate', '>=', $this->endDatetime);
                                            })
                                            ->whereHas('startTime', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') <= DATE_FORMAT('" . $this->startDatetime->format('H:i') . "', '%H:%i')");
                                            })
                                            ->whereHas('endTime', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') >= DATE_FORMAT('" . $this->endDatetime->format('H:i') . "', '%H:%i')");
                                            });
                                    })
                                    ->orWhere(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query
                                                    ->whereDate('RealDate', '>=', $this->startDatetime)
                                                    ->whereDate('RealDate', '<=', $this->endDatetime);
                                            })
                                            ->whereHas('startTime', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') >= DATE_FORMAT('" . $this->startDatetime->format('H:i') . "', '%H:%i')")
                                                    ->whereRaw("DATE_FORMAT(time, '%H:%i') <= DATE_FORMAT('" . $this->endDatetime->format('H:i') . "', '%H:%i')");
                                            });
                                    });
                            });

                    })
                    ->orWhere(function ($query) {
                        $query
                            ->where(function ($query) {
                                $query
                                    ->where(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') <= DATE_FORMAT('" . $this->startDatetime->format('Y-m-d') . "', '%m-%d')");
                                            })
                                            ->whereHas('endDate', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') >= DATE_FORMAT('" . $this->startDatetime->format('Y-m-d') . "', '%m-%d')");
                                            });
                                    })
                                    ->orWhere(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') <= DATE_FORMAT('" . $this->startDatetime->format('Y-m-d') . "', '%m-%d')");
                                            })
                                            ->whereHas('endDate', function ($query) {
                                                $query
                                                    ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') >= DATE_FORMAT('" . $this->endDatetime->format('Y-m-d') . "', '%m-%d')");
                                            });
                                    })
                                    ->orWhere(function ($query) {
                                        $query
                                            ->whereHas('startDate', function ($query) {
                                                $query
                                                    ->where(function ($query) {
                                                        $query
                                                            ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') >= DATE_FORMAT('" . $this->startDatetime->format('Y-m-d') . "', '%m-%d')");
                                                    })
                                                    ->where(function ($query) {
                                                        $query
                                                            ->whereRaw("DATE_FORMAT(RealDate, '%m-%d') <= DATE_FORMAT('" . $this->endDatetime->format('Y-m-d') . "', '%m-%d')");
                                                    });

                                            });
                                    });
                            });

                    });
            })
            ->count();

        return !($vacationCounts > 0);

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
