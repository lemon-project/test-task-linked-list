<?php

namespace LemonProject\SortedList\Validators;

use LemonProject\SortedList\Exceptions\InvalidValueTypeException;

/**
 * Validator interface
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
interface Validator
{
    public const string TYPE_INT    = 'integer';
    public const string TYPE_STRING = 'string';
    
    /**
     * Validate the value
     *
     * @param mixed $value
     * @return void
     * @throws InvalidValueTypeException
     */
    public function validate(mixed $value): void;
    
    /**
     * Returns the type of the validator
     *
     * @return string
     */
    public function getType(): string;
}