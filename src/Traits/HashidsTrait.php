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
        return in_array(request()->route('accessarea'), config('cortex.foundation.obscure'))
            ? Hashids::encode($this->getAttribute($this->getKeyName()), random_int(1, 999))
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
        return in_array(request()->route('accessarea'), config('cortex.foundation.obscure'))
            ? $this->where($this->getKeyName(), optional(Hashids::decode($value))[0])->first()
            : $this->where($this->getRouteKeyName(), $value)->first();
    }
}
