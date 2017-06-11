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

declare(strict_types=1);

namespace Rinvex\Support\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getValidatorInstance()
    {
        if (method_exists($this, 'process')) {
            $this->replace($this->container->call([$this, 'process'], [$this->all()]));
        }

        return parent::getValidatorInstance();
    }
}
