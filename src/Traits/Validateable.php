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

namespace Rinvex\Support\Traits;

use Illuminate\Contracts\Validation\Factory;

trait Validateable
{
    /**
     * The validation factory instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validationFactory;

    /**
     * The validation bindings.
     *
     * @var array
     */
    protected $validationBindings = [];

    /**
     * The validation rules.
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * The validation messages.
     *
     * @var array
     */
    protected $validationMessages = [];

    /**
     * The validation custom attributes.
     *
     * @var array
     */
    protected $validationCustomAttributes = [];

    /**
     * Set the validation factory instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $validationFactory
     *
     * @return $this
     */
    public function setValidationFactory(Factory $validationFactory)
    {
        $this->validationFactory = $validationFactory;

        return $this;
    }

    /**
     * Get the validation factory instance.
     *
     * @return \Illuminate\Contracts\Validation\Factory
     */
    public function getValidationFactory()
    {
        return $this->validationFactory ?: app(Factory::class);
    }

    /**
     * Set the validation rules.
     *
     * @param array $validationRules
     *
     * @return $this
     */
    public function setValidationRules(array $validationRules)
    {
        $this->validationRules = $validationRules;

        return $this;
    }

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * Set the validation messages.
     *
     * @param array $validationMessages
     *
     * @return $this
     */
    public function setValidationMessages(array $validationMessages)
    {
        $this->validationMessages = $validationMessages;

        return $this;
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function getValidationMessages()
    {
        return $this->validationMessages;
    }

    /**
     * Set the validation custom attributes.
     *
     * @param array $validationCustomAttributes
     *
     * @return $this
     */
    public function setValidationCustomAttributes(array $validationCustomAttributes)
    {
        $this->validationCustomAttributes = $validationCustomAttributes;

        return $this;
    }

    /**
     * Get the validation custom attributes.
     *
     * @return array
     */
    public function getValidationCustomAttributes()
    {
        return $this->validationCustomAttributes;
    }

    /**
     * Set the validation bindings.
     *
     * @param array $validationBindings
     *
     * @return $this
     */
    public function setValidationBindings(array $validationBindings)
    {
        $this->validationBindings = $validationBindings;

        return $this;
    }

    /**
     * Get the validation bindings.
     *
     * @return array
     */
    public function getValidationBindings()
    {
        return $this->validationBindings;
    }

    /**
     * Get the bound validation rules.
     *
     * @return array
     */
    protected function getBoundValidationRules()
    {
        $validationRules    = $this->getValidationRules();
        $validationBindings = $this->getValidationBindings();

        foreach ($validationRules as $key => $value) {
            if ($binding = array_get($validationBindings, $key)) {
                $validationRules[$key] = str_replace("{{{$key}}}", $binding, $value);
            }
        }

        return $validationRules;
    }

    /**
     * Validate passed data.
     *
     * @param array $data
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validate(array $data)
    {
        $validationRules = $this->getBoundValidationRules();

        $validationMessages = $this->getValidationMessages();

        $validationCustomAttributes = $this->getValidationCustomAttributes();

        return $this->getValidationFactory()->make($data, $validationRules, $validationMessages, $validationCustomAttributes);
    }
}
