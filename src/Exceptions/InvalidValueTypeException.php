<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Exceptions;

use InvalidArgumentException;
use Throwable;

/**
 * InvalidValueTypeException class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class InvalidValueTypeException extends InvalidArgumentException
{
    /**
     * InvalidValueTypeException constructor
     */
    public function __construct(
        string $message = 'Invalid value type provided.',
        int $code = 400,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}