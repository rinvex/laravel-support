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

namespace Rinvex\Support\Traits;

use Illuminate\Http\JsonResponse;

trait Redirectable
{
    /**
     * Return redirect response.
     *
     * @param array $arguments
     * @param string|null $statusCode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(array $arguments, $statusCode = null)
    {
        $redirect   = redirect();
        $statusCode = $statusCode ?: isset($arguments['withErrors']) ? 422 : 200;

        if ((request()->ajax() && ! request()->pjax()) || request()->wantsJson()) {
            return new JsonResponse($arguments['withErrors'] ?: $arguments['with'] ?: 'OK', $statusCode);
        }

        foreach ($arguments as $key => $value) {
            if (in_array($key, ['home', 'back'])) {
                $redirect = $redirect->{$key}();
            } else {
                $redirect = $redirect->{$key}($value);
            }
        }

        return $redirect;
    }
}
