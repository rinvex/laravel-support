<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Support\Arr;

trait Escaper
{
    /**
     * Escape all values.
     *
     * @param array $data
     *
     * @return array
     */
    protected function escape(array $data): array
    {
        $arrayDot = array_filter(Arr::dot($data));

        foreach ($arrayDot as $key => $value) {
            if (is_string($value)) {
                $arrayDot[$key] = e($value);
            }
        }

        foreach ($arrayDot as $key => $value) {
            Arr::set($data, $key, $value);
        }

        return $data;
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator($validator): void
    {
        // Sanitize input data before submission
        $this->replace($this->escape($this->all()));
    }
}
