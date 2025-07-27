<?php

namespace Modules\GoogleAnalytics\Exceptions;

use DateTimeInterface;
use Exception;

class InvalidPeriod extends Exception
{
    public static function startDateCannotBeAfterEndDate(DateTimeInterface $startDate, DateTimeInterface $endDate): static
    {
        return new static(__("Start date :s cannot be after end date :e.", ['s' => $startDate->format('Y-m-d'), 'e' => $endDate->format('Y-m-d')]));
    }
}
