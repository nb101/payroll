<?php

namespace App\Contracts;
/**
 * TimeAhead Interface
 * Interface to be implemented by a concrete class that calculates time ahead for a specified number of iterations
 */

interface TimeAhead
{
    public function getTimeAhead(int $iterations)  : array;
}
