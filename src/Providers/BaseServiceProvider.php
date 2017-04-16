<?php

declare(strict_types=1);

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
