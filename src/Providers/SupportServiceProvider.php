<?php

declare(strict_types=1);

namespace Rinvex\Support\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Rinvex\Support\Validators\UniqueWithValidator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class SupportServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Add strip_tags validation rule
        Validator::extend('strip_tags', function ($attribute, $value) {
            return is_string($value) && strip_tags($value) === $value;
        }, trans('validation.invalid_strip_tags'));

        // Add time offset validation rule
        Validator::extend('timeoffset', function ($attribute, $value) {
            return array_key_exists($value, timeoffsets());
        }, trans('validation.invalid_timeoffset'));

        Collection::macro('similar', function (Collection $newCollection) {
            return $newCollection->diff($this)->isEmpty() && $this->diff($newCollection)->isEmpty();
        });

        // Add support for unique_with validator
        ValidatorFacade::extend('unique_with', UniqueWithValidator::class.'@validateUniqueWith', trans('validation.unique_with'));
        ValidatorFacade::replacer('unique_with', function () {
            return call_user_func_array([new UniqueWithValidator(), 'replaceUniqueWith'], func_get_args());
        });
    }
}
