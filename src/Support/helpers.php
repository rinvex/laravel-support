<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

if (! function_exists('extract_title')) {
    /**
     * Extract page title from breadcrumbs.
     *
     * @return string
     */
    function extract_title(HtmlString $breadcrumbs, string $separator = ' » ')
    {
        return Str::afterLast(preg_replace('/[\n\r\s]+/', ' ', strip_tags(Str::replaceLast($separator, '', str_replace('</li>', $separator, $breadcrumbs)))), $separator)." {$separator} ".config('app.name');
    }
}

if (! function_exists('domain')) {
    /**
     * Return domain host.
     *
     * @return string
     */
    function domain()
    {
        return parse_url(config('app.url'))['host'];
    }
}

if (! function_exists('intend')) {
    /**
     * Return redirect response.
     *
     * @param array $arguments
     * @param int   $status
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    function intend(array $arguments, int $status = 302)
    {
        $redirect = redirect(Arr::pull($arguments, 'url'), $status);

        if (request()->expectsJson()) {
            $response = collect($arguments['withErrors'] ?? $arguments['with']);

            return response()->json([$response->flatten()->first() ?? 'OK']);
        }

        foreach ($arguments as $key => $value) {
            $redirect = in_array($key, ['home', 'back']) ? $redirect->{$key}() : $redirect->{$key}($value);
        }

        return $redirect;
    }
}

if (! function_exists('mimetypes')) {
    /**
     * Get valid mime types.
     *
     * @see https://github.com/symfony/http-foundation/blob/3.0/File/MimeType/MimeTypeExtensionGuesser.php
     * @see http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     *
     * @return array
     */
    function mimetypes()
    {
        return json_decode(file_get_contents(__DIR__.'/../../resources/data/mimetypes.json'), true);
    }
}

if (! function_exists('timezones')) {
    /**
     * Get valid timezones.
     *
     * @return array
     */
    function timezones()
    {
        return array_combine(timezone_identifiers_list(), timezone_identifiers_list());
    }
}

if (! function_exists('timeoffsets')) {
    /**
     * Get valid time offsets.
     *
     * @return array
     */
    function timeoffsets()
    {
        return [
            '-1200' => 'UTC -12:00',
            '-1100' => 'UTC -11:00',
            '-1000' => 'UTC -10:00',
            '-0930' => 'UTC -09:30',
            '-0900' => 'UTC -09:00',
            '-0800' => 'UTC -08:00',
            '-0700' => 'UTC -07:00',
            '-0600' => 'UTC -06:00',
            '-0500' => 'UTC -05:00',
            '-0400' => 'UTC -04:00',
            '-0330' => 'UTC -03:30',
            '-0300' => 'UTC -03:00',
            '-0200' => 'UTC -02:00',
            '-0100' => 'UTC -01:00',
            '+0000' => 'UTC ±00:00',
            '+0100' => 'UTC +01:00',
            '+0200' => 'UTC +02:00',
            '+0300' => 'UTC +03:00',
            '+0330' => 'UTC +03:30',
            '+0400' => 'UTC +04:00',
            '+0430' => 'UTC +04:30',
            '+0500' => 'UTC +05:00',
            '+0530' => 'UTC +05:30',
            '+0545' => 'UTC +05:45',
            '+0600' => 'UTC +06:00',
            '+0630' => 'UTC +06:30',
            '+0700' => 'UTC +07:00',
            '+0800' => 'UTC +08:00',
            '+0845' => 'UTC +08:45',
            '+0900' => 'UTC +09:00',
            '+0930' => 'UTC +09:30',
            '+1000' => 'UTC +10:00',
            '+1030' => 'UTC +10:30',
            '+1100' => 'UTC +11:00',
            '+1200' => 'UTC +12:00',
            '+1245' => 'UTC +12:45',
            '+1300' => 'UTC +13:00',
            '+1400' => 'UTC +14:00',
        ];
    }
}

if (! function_exists('array_search_recursive')) {
    /**
     * Recursively searches the array for a given value and returns the corresponding key if successful.
     *
     * @param mixed $needle
     * @param array $haystack
     *
     * @return mixed
     */
    function array_search_recursive($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value || (is_array($value) && array_search_recursive($needle, $value) !== false)) {
                return $current_key;
            }
        }

        return false;
    }
}

if (! function_exists('array_trim_recursive')) {
    /**
     * Recursively trim elements of the given array.
     *
     * @param mixed  $values
     * @param string $charlist
     *
     * @return mixed
     */
    function array_trim_recursive($values, $charlist = " \t\n\r\0\x0B")
    {
        if (is_array($values)) {
            return array_map('array_trim_recursive', $values);
        }

        return is_string($values) ? trim($values, $charlist) : $values;
    }
}

if (! function_exists('array_filter_recursive')) {
    /**
     * Recursively filter empty strings and null elements of the given array.
     *
     * @param array $values
     * @param bool  $strOnly
     *
     * @return mixed
     */
    function array_filter_recursive($values, $strOnly = true)
    {
        foreach ($values as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value);
            }
        }

        return ! $strOnly ? array_filter($values) : array_filter($values, function ($item) {
            return ! is_null($item) && ! ((is_string($item) || is_array($item)) && empty($item));
        });
    }
}
