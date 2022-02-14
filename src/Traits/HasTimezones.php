<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

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
        $datetime = $value;
        $timezone = request()->user()?->timezone;

        $thisIsUpdateRequest = Arr::first(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 30), function ($trace) {
            return $trace['function'] === 'setAttribute';
        });

        if ($thisIsUpdateRequest) {
            if (is_string($datetime)) {
                $datetime = Date::parse($datetime, $timezone);
            }

            return $datetime->setTimezone(config('app.timezone'));
        }

        $datetime = parent::asDateTime($datetime);

        if (! $timezone || $timezone === config('app.timezone')) {
            return $datetime;
        }

        return $datetime->setTimezone($timezone);
    }

    /**
     * Get a fresh timestamp for the model.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function freshTimestamp()
    {
        $now = Date::now();

        $timezone = request()->user()?->timezone;

        return (! $timezone || $timezone === config('app.timezone')) ? $now : $now->setTimezone($timezone);
    }
}
