<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        return $this->shouldBeHashed() ? $this->getHashid()
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
        return $this->shouldBeHashed()
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
        return $this->shouldBeHashed()
            ? optional(Hashids::decode($value))[0]
            : $value;
    }

    /**
     * Check if model key should be hashed or not.
     *
     * @return bool
     */
    protected function shouldBeHashed(): bool
    {
        $accessareas = (array) $this->obscure + app('accessareas')->where('is_obscured', true)->pluck('slug')->toArray();

        return in_array(request()->accessarea(), $accessareas) && in_array($this->getRouteKeyName(), config('cortex.foundation.obscure.hashed_keys'));
    }

    /**
     * Check if model key should be hashed or not.
     *
     * @return string
     */
    protected function getHashid(): string
    {
        return Hashids::encode($this->getAttribute($this->getKeyName()), config('cortex.foundation.obscure.numbers'));
    }

    /**
     * Get the model hashid.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hashid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getHashid(),
        );
    }
}
