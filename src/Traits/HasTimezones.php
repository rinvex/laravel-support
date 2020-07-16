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

        $setAttributeCalled = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 30), function ($trace) {
            return $trace['function'] === 'setAttribute';
        });

        // When setting attributes, skip custom timezone setting,
        // and use default application settings for consistent storage!
        if (! $setAttributeCalled && app()->bound('request.user') && $timezone = optional(app('request.user'))->timezone) {
            $datetime->setTimezone(new DateTimeZone($timezone));
        }

        return $datetime;
    }
}
