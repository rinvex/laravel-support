<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Watson\Validating\Injectors\UniqueWithInjector;
use Watson\Validating\ValidatingTrait as BaseValidatingTrait;

trait ValidatingTrait
{
    use UniqueWithInjector;
    use BaseValidatingTrait;

    /**
     * Register a validating event with the dispatcher.
     *
     * @param \Closure|string $callback
     *
     * @return void
     */
    public static function validating($callback)
    {
        static::registerModelEvent('validating', $callback);
    }

    /**
     * Register a validated event with the dispatcher.
     *
     * @param \Closure|string $callback
     *
     * @return void
     */
    public static function validated($callback)
    {
        static::registerModelEvent('validated', $callback);
    }
}
