<?php

declare(strict_types=1);

namespace Rinvex\Support\Traits;

use Illuminate\Support\Facades\Validator;

trait ArtisanCanValidateAnswers
{
    /**
     * Require valid answer for the asked question.
     *
     * @param string       $question
     * @param string       $field
     * @param string|array $rules
     * @param null         $default
     *
     * @return mixed
     */
    protected function askValid($question, $field, $rules, $default = null)
    {
        $value = $this->ask($question, $default);

        if ($message = $this->validateInput($field, $value, $rules)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules, $default);
        }

        return $value;
    }

    /**
     * Validate input field.
     *
     * @param string       $field
     * @param string       $value
     * @param string|array $rules
     *
     * @return string|null
     */
    protected function validateInput($field, $value, $rules)
    {
        $validator = Validator::make(
            [$field => $value],
            [$field => $rules]
        );

        return $validator->fails() ? $validator->errors()->first($field) : null;
    }
}
