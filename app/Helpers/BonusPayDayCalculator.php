<?php

namespace App\Helpers;
use App\Month;
/*
|--------------------------------------------------------------------------
| BonusPayDayCalculator
|--------------------------------------------------------------------------
| Calculates day for bonus payment for payroll
| If bonus day is on a weekday, it returns the friday of the week
*/

class BonusPayDayCalculator
{

    /**
     * Create a new BonusPayDayCalculator instance.
     * @param Month $month
     * @param int $bonus_day
     * @return void
     */
    public function __construct(Month $month, int $bonus_day)
    {
        $this->bonus_day = $bonus_day;
        $this->month = $month;
    }


    /**
     * the day bonus is usually payed out
     * @var $bonus_day
     */
    protected $bonus_day;

    /**
     * the month for bonus day to be calculated for
     * @var $month
     */
    protected $month;

    /**
     * @return mixed
     */
    public function getBonusPayoutDay()
    {
        $y_m = $this->month->getYear() . '-' . $this->month->getMonth();
        $bonus_day = strtotime($y_m . '-' . $this->bonus_day);
        return (date('N', $bonus_day ) <= 5) ? $y_m . '-10' :
            date('Y-m-d', strtotime("next monday", $bonus_day));
    }

}
