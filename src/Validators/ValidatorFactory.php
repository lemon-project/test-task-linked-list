<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Validators;

use InvalidArgumentException;

/**
 * ValidatorFactory class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class ValidatorFactory
{
    /**
     * Returns a validator instance based on the type
     *
     * @param string $type
     *
     * @return Validator
     */
    public function make(string $type): Validator
    {
        return match ($type) {
            Validator::TYPE_INT => new IntegerValidator(),
            Validator::TYPE_STRING => new StringValidator(),
            default => throw new InvalidArgumentException('Invalid type'),
        };
    }
}