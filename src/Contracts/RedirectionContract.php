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

namespace Rinvex\Support\Contracts;

interface RedirectionContract
{
    /**
     * Return redirect response.
     *
     * @param array       $arguments
     * @param string|null $statusCode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(array $arguments, $statusCode = null);
}
