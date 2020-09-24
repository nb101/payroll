<?php

namespace App;
/*
|--------------------------------------------------------------------------
| Month
|--------------------------------------------------------------------------
|Class represents a month in a specific year
*/
class Month
{

    /**
     * Create a new month instance.
     * @param string $month
     * @param string $current_year
     * @return void
     */
    public function __construct(string $month, string $current_year)
    {
        $this->month= $month;
        $this->current_year = $current_year;
    }

    /**
     * numeric representation of month | stored as string
     * @var string
     */
    protected $month;

    /**
     * numeric representation of current year the month belongs to | stored as string
     * @var string
     */
    protected $current_year;

    /**
     * returns Last day of the month
     */
    public function lastDay() : string {
     return  strtotime($this->current_year . '-' . $this->month . '-' .
         date('t',strtotime($this->current_year . '-' . $this->month . '-01')));
    }

    /**
     * returns First day of the month
     */
    public function firstDay() : string {
        return strtotime($this->current_year . '-' . $this->month . '-01');
    }

    /**
     * @return string
     */
    public function getMonth() : string
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->current_year;
    }

}
