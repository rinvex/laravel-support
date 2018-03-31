<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

trait Escaper
{
    /**
     * Escape all values of row.
     *
     * @param array $row
     *
     * @return array
     */
    protected function escapeRow(array $row): array
    {
        $arrayDot = array_filter(array_dot($row));

        foreach ($arrayDot as $key => $value) {
            $arrayDot[$key] = e($value);
        }

        foreach ($arrayDot as $key => $value) {
            array_set($row, $key, $value);
        }

        return $row;
    }
}
