<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use DateTimeZone;
use Illuminate\Support\Arr;

trait HasTimezones
{
    /**
     * Return a timestamp as DateTime object.
     *
     * @param mixed $value
     *
     * @return \Illuminate\Support\Carbon
     */
    protected function asDateTime($value)
    {
        $datetime = parent::asDateTime($value);
        $timezone = optional(request()->user())->timezone;
        $thisIsUpdateRequest = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 30), function ($trace) {
            return $trace['function'] === 'setAttribute';
        });

        if (! $timezone || $timezone === config('app.timezone') || $thisIsUpdateRequest) {
            return $datetime;
        }

        return $datetime->setTimezone(new DateTimeZone($timezone));
    }
}
