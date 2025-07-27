<?php

namespace Modules\GoogleAnalytics\Services;

use Carbon\Carbon;
use DateTimeInterface;
use Google\Analytics\Data\V1beta\DateRange;
use Modules\GoogleAnalytics\Exceptions\InvalidPeriod;

class Period
{
    /**
     * @var DateTimeInterface
     */
    public DateTimeInterface $startDate;

    /**
     * @var DateTimeInterface
     */
    public DateTimeInterface $endDate;

    public static function create(DateTimeInterface $startDate, DateTimeInterface $endDate): self
    {
        return new static($startDate, $endDate);
    }

    /**
     * Period of days
     *
     * @param integer $numberOfDays
     * @return static
     */
    public static function days(int $numberOfDays): static
    {
        $endDate = Carbon::today();

        $startDate = Carbon::today()->subDays($numberOfDays)->startOfDay();

        return new static($startDate, $endDate);
    }

    /**
     * Period of months
     *
     * @param integer $numberOfMonths
     * @return static
     */
    public static function months(int $numberOfMonths): static
    {
        $endDate = Carbon::today();

        $startDate = Carbon::today()->subMonths($numberOfMonths)->startOfDay();

        return new static($startDate, $endDate);
    }

    /**
     * Period of years
     *
     * @param integer $numberOfYears
     * @return static
     */
    public static function years(int $numberOfYears): static
    {
        $endDate = Carbon::today();

        $startDate = Carbon::today()->subYears($numberOfYears)->startOfDay();

        return new static($startDate, $endDate);
    }

    public function __construct(DateTimeInterface $startDate, DateTimeInterface $endDate)
    {
        if ($startDate > $endDate) {
            throw InvalidPeriod::startDateCannotBeAfterEndDate($startDate, $endDate);
        }

        $this->startDate = $startDate;

        $this->endDate = $endDate;
    }

    /**
     * Return date range
     *
     * @return DateRange
     */
    public function toDateRange(): DateRange
    {
        return (new DateRange())
            ->setStartDate($this->startDate->format('Y-m-d'))
            ->setEndDate($this->endDate->format('Y-m-d'));
    }
}
