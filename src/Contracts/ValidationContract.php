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

namespace Rinvex\Support\Contracts;

use Illuminate\Contracts\Validation\Factory;

interface ValidationContract
{
    /**
     * Set the validation factory instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $validationFactory
     *
     * @return $this
     */
    public function setValidationFactory(Factory $validationFactory);

    /**
     * Get the validation factory instance.
     *
     * @return \Illuminate\Contracts\Validation\Factory
     */
    public function getValidationFactory();

    /**
     * Set the validation rules.
     *
     * @param array $validationRules
     *
     * @return $this
     */
    public function setValidationRules(array $validationRules);

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function getValidationRules();

    /**
     * Set the validation messages.
     *
     * @param array $validationMessages
     *
     * @return $this
     */
    public function setValidationMessages(array $validationMessages);

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function getValidationMessages();

    /**
     * Set the validation custom attributes.
     *
     * @param array $validationCustomAttributes
     *
     * @return $this
     */
    public function setValidationCustomAttributes(array $validationCustomAttributes);

    /**
     * Get the validation custom attributes.
     *
     * @return array
     */
    public function getValidationCustomAttributes();

    /**
     * Set the validation bindings.
     *
     * @param array $validationBindings
     *
     * @return $this
     */
    public function setValidationBindings(array $validationBindings);

    /**
     * Get the validation bindings.
     *
     * @return array
     */
    public function getValidationBindings();

    /**
     * Validate passed data.
     *
     * @param array $data
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validate(array $data);
}
