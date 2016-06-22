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
     * @param array       $arguments
     * @param string|null $statusCode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(array $arguments, $statusCode = null)
    {
        $redirect   = redirect();
        $statusCode = $statusCode ?: isset($arguments['withErrors']) ? 422 : 200;

        if ($this->isJsonable()) {
            return new JsonResponse($arguments['withErrors'] ?: $arguments['with'] ?: 'OK', $statusCode);
        }

        foreach ($arguments as $key => $value) {
            $redirect = in_array($key, ['home', 'back']) ? $redirect->{$key}() : $redirect->{$key}($value);
        }

        return $redirect;
    }

    /**
     * Check if the request requires Json response.
     *
     * @return bool
     */
    protected function isJsonable()
    {
        return (request()->ajax() && ! request()->pjax()) || request()->wantsJson();
    }
}
