<?php

/*
 * NOTICE OF LICENSE
 *
 * Part of the Rinvex Support Package.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Rinvex Support Package
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */

use Illuminate\Support\Str;

if (! function_exists('lower_case')) {
    /**
     * Convert the given string to lower-case.
     *
     * @param string $value
     *
     * @return string
     */
    function lower_case($value)
    {
        return Str::lower($value);
    }
}

if (! function_exists('upper_case')) {
    /**
     * Convert the given string to upper-case.
     *
     * @param string $value
     *
     * @return string
     */
    function upper_case($value)
    {
        return Str::upper($value);
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
        return json_decode(file_get_contents(__DIR__.'/../../resources/fixtures/mimetypes.json'), true);
    }
}

if (! function_exists('timezones')) {
    /**
     * Get valid timezones.
     * This list is based upon the timezone database version 2016.1.
     *
     * @see http://php.net/manual/en/timezones.php
     *
     * @return array
     */
    function timezones()
    {
        return json_decode(file_get_contents(__DIR__.'/../../resources/fixtures/timezones.json'), true);
    }
}
