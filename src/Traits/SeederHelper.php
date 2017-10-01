<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Closure;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

trait SeederHelper
{
    /**
     * Seed the given resources.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $seeder
     * @param array                               $initialExclude
     * @param \Closure                            $callback
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function seedResources(Model $model, string $seeder, array $initialExclude = [], Closure $callback = null)
    {
        if (! file_exists($seeder)) {
            throw new Exception("Resources seeder file '{$seeder}' does NOT exist!");
        }

        $this->warn('Seeding: '.str_after($seeder, $this->laravel->basePath().'/'));

        $ids = [];

        // Create new resources
        foreach (json_decode(file_get_contents($seeder), true) as $resource) {
            $ids[] = $model->firstOrCreate(array_except($resource, $initialExclude), array_only($resource, $initialExclude))->getKey();
        }

        $this->info('Seeded: '.str_after($seeder, $this->laravel->basePath().'/'));

        ! $callback || call_user_func($callback, $ids);
    }

    /**
     * Ensure existing database tables.
     *
     * @param string $package
     *
     * @return bool
     */
    protected function ensureExistingDatabaseTables(string $package)
    {
        if (! $this->hasDatabaseTables($package)) {
            $package = explode('/', $package);
            $this->call("{$package[0]}:migrate:{$package[1]}");
        }

        return true;
    }

    /**
     * Check if all required database tables exists.
     *
     * @param string $package
     *
     * @return bool
     */
    protected function hasDatabaseTables(string $package)
    {
        $package = explode('/', $package);

        foreach (config("{$package[0]}.{$package[1]}.tables") as $table) {
            if (! Schema::hasTable($table)) {
                return false;
            }
        }

        return true;
    }
}
