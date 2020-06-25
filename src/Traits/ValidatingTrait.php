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
     * Merge new validation rules with existing validation rules on the model.
     *
     * @param array $rules
     *
     * @return $this
     */
    public function mergeRules(array $rules)
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

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
