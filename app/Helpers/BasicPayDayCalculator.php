<?php

namespace App\Helpers;
use App\Month;
/*
|--------------------------------------------------------------------------
| BasicPayDayCalculator
|--------------------------------------------------------------------------
|
| Calculates last working day of a given month for payroll
|
*/

class BasicPayDayCalculator
{
    /**
     * Create a new BonusPayDayCalculator instance.
     * @param  Month  $month
     * @return void
     */

    public function __construct(Month $month)
    {
        $this->month = $month;
    }

    /**
     * the month for which pay day need to be calculated for
     * @var Month
     */
    protected $month;

    /**
     * Return the last working day of the given month
     * @return string
     */
    public function getBasicPayDay() : string
    {
        $last_day = $this->month->lastDay();
        return (date('N', $last_day ) <= 5) ?
            date('Y-m-d', $last_day) : date('Y-m-d', strtotime("last friday", $last_day));
    }
}
