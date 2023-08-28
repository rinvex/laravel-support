<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Support\Str;

trait ConsoleTools
{
    /**
     * Register a view file namespace.
     *
     * @override \Illuminate\Support\ServiceProvider::loadViewsFrom This method override views-loading to prepend
     *           namespaces instead of appending, allowing extensions to have precedence and override module views.
     *           We also changed `$appPath` to support multiple themes, and removed `/vendor` to simplify the path.
     *
     * @param string|array $path
     * @param string       $namespace
     *
     * @return void
     */
    protected function loadViewsFrom($path, $namespace)
    {
        $this->callAfterResolving('view', function ($view) use ($path, $namespace) {
            $view->prependNamespace($namespace, $path);

            if (isset($this->app->config['view']['paths']) && is_array($this->app->config['view']['paths'])) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath.'/'.$namespace.'/views')) {
                        $hints = $view->getFinder()->getHints();

                        if ($exists = array_search($appPath, $hints[$namespace])) {
                            unset($hints[$namespace][$exists]);
                            $view->getFinder()->replaceNamespace($namespace, array_values($hints[$namespace]));
                        }

                        $view->prependNamespace($namespace, $appPath);
                    }
                }
            }
        });
    }

    /**
     * Register migration paths to be published by the publish command.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return void
     */
    protected function publishMigrationsFrom(string $path, string $namespace): void
    {
        if (file_exists($path)) {
            $stubs = $this->app['files']->glob($path.'/*.php');
            $existing = $this->app['files']->glob($this->app->databasePath('migrations/'.$namespace.'/*.php'));

            $migrations = collect($stubs)->flatMap(function ($migration) use ($existing, $namespace) {
                $sequence = mb_substr(basename($migration), 0, 17);
                $match = collect($existing)->first(fn ($item, $key) => mb_strpos($item, str_replace($sequence, '', basename($migration))) !== false);

                return [$migration => $this->app->databasePath('migrations/'.$namespace.'/'.($match ? basename($match) : date('Y_m_d_His', time() + mb_substr($sequence, -6)).str_replace($sequence, '', basename($migration))))];
            })->toArray();

            $this->publishes($migrations, $namespace.'::migrations');
        }
    }

    /**
     * Register config paths to be published by the publish command.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return void
     */
    protected function publishConfigFrom(string $path, string $namespace): void
    {
        ! file_exists($path) || $this->publishes([$path => $this->app->configPath(str_replace('/', '.', $namespace).'.php')], $namespace.'::config');
    }

    /**
     * Register view paths to be published by the publish command.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return void
     */
    protected function publishViewsFrom(string $path, string $namespace): void
    {
        ! file_exists($path) || $this->publishes([$path => $this->app->resourcePath('views/vendor/'.$namespace)], $namespace.'::views');
    }

    /**
     * Register lang paths to be published by the publish command.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return void
     */
    protected function publishTranslationsFrom(string $path, string $namespace): void
    {
        ! file_exists($path) || $this->publishes([$path => $this->app->resourcePath('lang/vendor/'.$namespace)], $namespace.'::lang');
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
            $this->app->singletonIf($model, $model);
        }
    }
}
