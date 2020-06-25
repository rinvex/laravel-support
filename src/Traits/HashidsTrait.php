<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashidsTrait
{
    /**
     * Get the value of the model's route key.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        $accessarea = app()->bound('request.accessarea') ? app('request.accessarea') : null;

        $obscure = property_exists($this, 'obscure') && is_array($this->obscure) ? $this->obscure : config('cortex.foundation.obscure');

        return in_array($accessarea, $obscure['areas'])
            ? Hashids::encode($this->getAttribute($this->getKeyName()), $obscure['rotate'] ? random_int(1, 999) : 1)
            : $this->getAttribute($this->getRouteKeyName());
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed       $value
     * @param string|null $field
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $accessarea = app()->bound('request.accessarea') ? app('request.accessarea') : null;
        $obscure = property_exists($this, 'obscure') && is_array($this->obscure) ? $this->obscure : config('cortex.foundation.obscure');

        return in_array($accessarea, $obscure['areas'])
            ? $this->where($field ?? $this->getKeyName(), optional(Hashids::decode($value))[0])->first()
            : $this->where($field ?? $this->getRouteKeyName(), $value)->first();
    }
}
