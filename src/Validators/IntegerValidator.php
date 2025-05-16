<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Validators;

use LemonProject\SortedList\Exceptions\InvalidValueTypeException;

/**
 * IntegerValidator class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class IntegerValidator implements Validator
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
        if (! is_int($value)) {
            throw new InvalidValueTypeException('Value must be an integer.');
        }
    }
    
    /**
     * Returns the type of the validator
     *
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE_INT;
    }
}