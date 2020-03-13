<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashidsTrait
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        $obscure = property_exists($this, 'obscure') && is_array($this->obscure) ? $this->obscure : config('cortex.foundation.obscure');

        return in_array(request()->route('accessarea'), $obscure['areas'])
            ? Hashids::encode($this->getAttribute($this->getKeyName()), $obscure['rotate'] ? random_int(1, 999) : 1)
            : $this->getAttribute($this->getRouteKeyName());
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        $obscure = property_exists($this, 'obscure') && is_array($this->obscure) ? $this->obscure : config('cortex.foundation.obscure');

        return in_array(request()->route('accessarea'), $obscure['areas'])
            ? $this->where($this->getKeyName(), optional(Hashids::decode($value))[0])->first()
            : $this->where($this->getRouteKeyName(), $value)->first();
    }
}
