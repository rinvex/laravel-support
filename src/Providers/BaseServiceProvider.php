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

namespace Rinvex\Support\Providers;

use Illuminate\Support\ServiceProvider;

abstract class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register an IoC binding if it's not already been registered.
     *
     * @param string               $abstract
     * @param \Closure|string|null $concrete
     * @param bool                 $shared
     * @param bool                 $force
     *
     * @return void
     */
    protected function bindIfNotBound($abstract, $concrete = null, $shared = true, $force = false)
    {
        if (! $this->app->bound($abstract) || $force) {
            $concrete = $concrete ?: $abstract;
            $this->app->bind($abstract, $concrete, $shared);
        }
    }
}
