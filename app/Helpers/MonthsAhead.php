<?php

namespace App\Helpers;
use App\Contracts\TimeAhead;
/*
|--------------------------------------------------------------------------
| MonthsAhead
|--------------------------------------------------------------------------
*/

class MonthsAhead implements TimeAhead
{
    /**
     * returns the months ahead for specified number of iteration
     * @param int $iterations
     * @return array $months
     */
    public function getTimeAhead(int $iterations) : array
    {
        $months = [];

        for ($x = 1; $x < ($iterations + 1); $x++) {
            $time = strtotime('+' . $x . ' months', strtotime(date('Y-M' . '-01')));
            $months[] = ['m' => date('m', $time), 'Y' => date('Y', $time)];
        }
        return $months;
    }
}
