<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;

trait HasSocialAttributes
{
    /**
     * Escape all values.
     *
     * @param array $data
     *
     * @return array
     */
    public function getSocialAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'social');
    }

    public function scopeWithSocial(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('social');
    }
}
