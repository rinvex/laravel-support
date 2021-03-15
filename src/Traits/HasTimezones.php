<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use DateTimeZone;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

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

        if (! $timezone || $timezone === config('app.timezone')) {
            return $datetime;
        }

        $thisIsUpdateRequest = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 30), function ($trace) {
            return $trace['function'] === 'setAttribute';
        });

        if ($thisIsUpdateRequest) {
            // When updating attributes, we need to reset user timezone to system timezone before saving!
            return Date::parse($datetime->toDateTimeString(), $timezone)->setTimezone(config('app.timezone'));
        }

        return $datetime->setTimezone(new DateTimeZone($timezone));
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function freshTimestamp()
    {
        $now = Date::now();

        $timezone = optional(request()->user())->timezone;

        return (! $timezone || $timezone === config('app.timezone')) ? $now : $now->setTimezone($timezone);
    }
}
