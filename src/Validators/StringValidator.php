<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Validators;

use LemonProject\SortedList\Exceptions\InvalidValueTypeException;

/**
 * StringValidator class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class StringValidator implements Validator
{
    /**
     * Validate the value
     *
     * @param mixed $value
     *
     * @return void
     * @throws InvalidValueTypeException
     */
    public function validate(mixed $value): void
    {
        if (! is_string($value)) {
            throw new InvalidValueTypeException('Value must be a string.');
        }
    }
    
    /**
     * Returns the type of the validator
     *
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE_STRING;
    }
}