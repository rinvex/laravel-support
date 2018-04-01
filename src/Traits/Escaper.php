<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

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
        $arrayDot = array_filter(array_dot($data));

        foreach ($arrayDot as $key => $value) {
            if (is_string($value)) {
                $arrayDot[$key] = e($value);
            }
        }

        foreach ($arrayDot as $key => $value) {
            array_set($data, $key, $value);
        }

        return $data;
    }
}
