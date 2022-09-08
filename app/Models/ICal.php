<?php

namespace App\Models;

use Eluceo\iCal\Domain\ValueObject\MultiDay;
use Eluceo\iCal\Domain\ValueObject\SingleDay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'house_id',
        'slug'
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function userVacations()
    {
        return $this->hasMany(Vacation::class, 'HouseId', 'house_id')->where('OwnerId', $this->user_id);
    }

    public function houseVacations()
    {
        return $this->hasMany(Vacation::class, 'HouseId', 'house_id');
    }

    public function toICSUrl() {

        $links = [];

        $vacations = $this->user->is_admin ? $this->houseVacations : $this->userVacations;

        foreach ($vacations as $vacation) {
            $from = $vacation->startDatetime->format('Y-m-d H:i:s');
            $to = $vacation->endDatetime->format('Y-m-d H:i:s');

            $from = \DateTime::createFromFormat('Y-m-d H:i:s', $from);
            $to = \DateTime::createFromFormat('Y-m-d H:i:s', $to);

            // this is the new library which we are trying
            $links[] = (new \Eluceo\iCal\Domain\Entity\Event())
                ->setSummary($vacation->VacationName)
//                ->setDescription('Location: ' . $vacation->DisplayIMR . ', More Information: ' . $vacation->FullURLtoEventDashboard)
                ->setOccurrence(new MultiDay(new \Eluceo\iCal\Domain\ValueObject\Date($from), new \Eluceo\iCal\Domain\ValueObject\Date($to)));
        }

        // this is the new library which we are trying
        $calendar = new \Eluceo\iCal\Domain\Entity\Calendar($links);

        // this is the new library which we are trying
        $componentFactory = new \Eluceo\iCal\Presentation\Factory\CalendarFactory();
        return $componentFactory->createCalendar($calendar);
    }
}
