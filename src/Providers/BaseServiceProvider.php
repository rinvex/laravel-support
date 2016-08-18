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
     * The alias pattern.
     *
     * @var string
     */
    protected $aliasPattern = '{{class}}Contract';

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
    protected function bind($abstract, $concrete = null, $shared = true, $force = false)
    {
        if (! $this->app->bound($abstract) || $force) {
            $concrete = $concrete ?: $abstract;
            $this->app->bind($abstract, $concrete, $shared);
        }
    }

    /**
     * Register an IoC binding whether it's already been registered or not.
     *
     * @param string               $abstract
     * @param \Closure|string|null $concrete
     * @param bool                 $shared
     * @param string|null          $alias
     * @param bool                 $force
     *
     * @return void
     */
    protected function bindAndAlias($abstract, $concrete = null, $shared = true, $alias = null, $force = false)
    {
        if (! $this->app->bound($abstract) || $force) {
            $concrete = $concrete ?: $abstract;
            $this->app->bind($abstract, $concrete, $shared);
            $this->app->alias($abstract, $this->prepareAlias($alias, $concrete));
        }
    }

    /**
     * Prepare the alias.
     *
     * @param string|null $alias
     * @param mixed       $concrete
     *
     * @return string
     */
    protected function prepareAlias($alias, $concrete)
    {
        if (! $alias && ! $concrete instanceof \Closure) {
            $concrete = str_replace('Repositories', 'Contracts', $concrete);
            $alias    = str_replace('{{class}}', $concrete, $this->aliasPattern);
        }

        return $alias;
    }
}
