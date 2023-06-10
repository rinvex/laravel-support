<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Support\Str;

trait ConsoleTools
{
    /**
     * Publish package migrations.
     *
     * @param string $package
     * @param bool   $isModule
     * @param string $extends
     *
     * @return void
     */
    protected function publishesMigrations(string $package, bool $isModule = false, string $extends = null): void
    {
        if (! $this->publishesResources()) {
            return;
        }

        $namespace = str_replace('laravel-', '', $package);
        $basePath = $isModule ? $this->app->path($package)
            : $this->app->basePath('vendor/'.$package);

        if (file_exists($path = $basePath.'/database/migrations')) {
            $stubs = $this->app['files']->glob($path.'/*.php');
            $existing = $this->app['files']->glob($this->app->databasePath('migrations/'.($extends ?? $package).'/*.php'));

            $migrations = collect($stubs)->flatMap(function ($migration) use ($existing, $package, $extends) {
                $sequence = mb_substr(basename($migration), 0, 17);
                $match = collect($existing)->first(function ($item, $key) use ($migration, $sequence) {
                    return mb_strpos($item, str_replace($sequence, '', basename($migration))) !== false;
                });

                return [$migration => $this->app->databasePath('migrations/'.($extends ?? $package).'/'.($match ? basename($match) : date('Y_m_d_His', time() + mb_substr($sequence, -6)).str_replace($sequence, '', basename($migration))))];
            })->toArray();

            $this->publishes($migrations, $namespace.'::migrations');
        }
    }

    /**
     * Publish package config.
     *
     * @param string $package
     * @param bool   $isModule
     *
     * @return void
     */
    protected function publishesConfig(string $package, bool $isModule = false): void
    {
        if (! $this->publishesResources()) {
            return;
        }

        $namespace = str_replace('laravel-', '', $package);
        $basePath = $isModule ? $this->app->path($package)
            : $this->app->basePath('vendor/'.$package);

        if (file_exists($path = $basePath.'/config/config.php')) {
            $this->publishes([$path => $this->app->configPath(str_replace('/', '.', $namespace).'.php')], $namespace.'::config');
        }
    }

    /**
     * Publish package views.
     *
     * @param string $package
     * @param bool   $isModule
     * @param string $extends
     *
     * @return void
     */
    protected function publishesViews(string $package, bool $isModule = false, string $extends = null): void
    {
        if (! $this->publishesResources()) {
            return;
        }

        $namespace = str_replace('laravel-', '', $extends ?? $package);
        $basePath = $isModule ? $this->app->path($package)
            : $this->app->basePath('vendor/'.$package);

        if (file_exists($path = $basePath.'/resources/views')) {
            $this->publishes([$path => $this->app->resourcePath('views/vendor/'.($extends ?? $package))], $namespace.'::views');
        }
    }

    /**
     * Publish package lang.
     *
     * @param string $package
     * @param bool   $isModule
     * @param string $extends
     *
     * @return void
     */
    protected function publishesLang(string $package, bool $isModule = false, string $extends = null): void
    {
        if (! $this->publishesResources()) {
            return;
        }

        $namespace = str_replace('laravel-', '', $extends ?? $package);
        $basePath = $isModule ? $this->app->path($package)
            : $this->app->basePath('vendor/'.$package);

        if (file_exists($path = $basePath.'/resources/lang')) {
            $this->publishes([$path => $this->app->resourcePath('lang/vendor/'.($extends ?? $package))], $namespace.'::lang');
        }
    }

    /**
     * Register models into IoC.
     *
     * @param array $models
     *
     * @return void
     */
    protected function registerModels(array $models): void
    {
        foreach ($models as $service => $class) {
            $this->app->singletonIf($service, $model = $this->app['config'][Str::replaceLast('.', '.models.', $service)]);
            $model === $class || $this->app->alias($service, $class);
        }
    }

    /**
     * Can publish resources.
     *
     * @return bool
     */
    protected function publishesResources(): bool
    {
        return ! $this->app->environment('production') || $this->app->runningInConsole();
    }

    /**
     * Can autoload migrations.
     *
     * @param string $module
     *
     * @return bool
     */
    protected function autoloadMigrations(string $module): bool
    {
        return $this->publishesResources() && $this->app['config'][str_replace(['laravel-', '/'], ['', '.'], $module).'.autoload_migrations'];
    }
}
