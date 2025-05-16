<?php

declare(strict_types=1);

namespace Validators;

use LemonProject\SortedList\Exceptions\InvalidValueTypeException;
use LemonProject\SortedList\Validators\IntegerValidator;
use LemonProject\SortedList\Validators\StringValidator;
use PHPUnit\Framework\TestCase;

/**
 * ValidatorTest test
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class ValidatorTest extends TestCase
{
    /**
     * Test StringValidator
     *
     * @return void
     */
    public function testStringValidator(): void
    {
        $validator = new StringValidator();

        // Valid string
        $validator->validate('test');

        // Invalid value
        $this->expectException(InvalidValueTypeException::class);
        $validator->validate(123);
    }
    
    /**
     * Test IntegerValidator
     *
     * @return void
     */
    public function testIntegerValidator(): void
    {
        $validator = new IntegerValidator();

        // Valid integer
        $validator->validate(123);

        // Invalid value
        $this->expectException(InvalidValueTypeException::class);
        $validator->validate('test');
    }
}