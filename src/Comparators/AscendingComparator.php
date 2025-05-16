<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Comparators;

/**
 * AscendingComparator class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class AscendingComparator implements Comparator
{
    /**
     * Compare two values
     *
     * @param mixed $a
     * @param mixed $b
     *
     * @return int
     */
    public function compare(mixed $a, mixed $b): int
    {
        if ($a === INF || $b === -INF) {
            return 1;
        }

        if ($a === -INF || $b === INF) {
            return -1;
        }

        return $a <=> $b;
    }
    
    /**
     * Returns the order
     *
     * @return string
     */
    public function getOrder(): string
    {
        return self::ORDER_ASC;
    }
}