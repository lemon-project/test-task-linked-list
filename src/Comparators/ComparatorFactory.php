<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Comparators;

use InvalidArgumentException;

/**
 * ComparatorFactory class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class ComparatorFactory
{
    /**
     * Returns a comparator instance based on the order type
     *
     * @param string $order
     *
     * @return Comparator
     */
    public function make(string $order): Comparator
    {
        return match ($order) {
            Comparator::ORDER_ASC => new AscendingComparator(),
            Comparator::ORDER_DESC => new DescendingComparator(),
            default => throw new InvalidArgumentException('Invalid order type'),
        };
    }
}