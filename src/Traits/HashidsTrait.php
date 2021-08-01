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
        $accessareas = (array) $this->obscure + ['accessareas' => app('accessareas')->where('is_obscured', true)->pluck('slug')->toArray()];

        return in_array(request()->accessarea(), $accessareas)
            ? Hashids::encode($this->getAttribute($this->getKeyName()), config('cortex.foundation.obscure'))
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
        $accessareas = (array) $this->obscure + ['accessareas' => app('accessareas')->where('is_obscured', true)->pluck('slug')->toArray()];

        return in_array(request()->accessarea(), $accessareas)
            ? $this->where($field ?? $this->getKeyName(), optional(Hashids::decode($value))[0])->first()
            : $this->where($field ?? $this->getRouteKeyName(), $value)->first();
    }

    /**
     * Unhash given value of the model.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function unhashId($value)
    {
        $accessareas = (array) $this->obscure + ['accessareas' => app('accessareas')->where('is_obscured', true)->pluck('slug')->toArray()];

        return in_array(request()->accessarea(), $accessareas) ? optional(Hashids::decode($value))[0] : $value;
    }
}
