<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug as BaseHasSlug;

trait HasSlug
{
    use BaseHasSlug;

    /**
     * Boot the trait.
     */
    protected static function bootHasSlug()
    {
        // Auto generate slugs early before validation
        static::validating(function (Model $model) {
            if ($model->exists && $model->getSlugOptions()->generateSlugsOnUpdate) {
                $model->generateSlugOnUpdate();
            } elseif (! $model->exists && $model->getSlugOptions()->generateSlugsOnCreate) {
                $model->generateSlugOnCreate();
            }
        });
    }
}
