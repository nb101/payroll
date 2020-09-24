<?php

namespace App;
use App\Contracts\PayrollMonth;
use App\Month;
/*
|--------------------------------------------------------------------------
| Month
|--------------------------------------------------------------------------
|Class represents a month in a specific year with added payroll features
*/
class PayRollableMonth extends Month implements PayrollMonth
{


}
