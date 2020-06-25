<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Error;
use Exception;
use BadMethodCallException;
use Illuminate\Support\Traits\Macroable as BaseMacroable;

trait Macroable
{
    use BaseMacroable {
        BaseMacroable::__call as macroableCall;
        BaseMacroable::__callStatic as macroableCallStatic;
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->{$method}(...$parameters);
        }

        try {
            return $this->forwardCallTo($this->newQuery(), $method, $parameters);
        } catch (Error | BadMethodCallException $e) {
            if ($method !== 'macroableCall') {
                return $this->macroableCall($method, $parameters);
            }
        }
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        try {
            return (new static())->{$method}(...$parameters);
        } catch (Exception $e) {
            if ($method !== 'macroableCallStatic') {
                return (new static())::macroableCallStatic($method, $parameters);
            }
        }
    }
}
