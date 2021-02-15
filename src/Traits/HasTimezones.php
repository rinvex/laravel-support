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
        $timezone = app()->bound('request.user') ? optional(app('request.user'))->timezone : null;
        $thisIsUpdateRequest = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 30), function ($trace) {
            return $trace['function'] === 'setAttribute';
        });

        if (! $timezone || $timezone === config('app.timezone') || $thisIsUpdateRequest) {
            return $datetime;
        }

        return $datetime->setTimezone(new DateTimeZone($timezone));
    }
}
