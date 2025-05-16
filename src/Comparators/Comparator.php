<?php

namespace LemonProject\SortedList\Comparators;

/**
 * Comparator interface
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
interface Comparator
{
    public const string ORDER_ASC  = 'ASC';
    public const string ORDER_DESC = 'DESC';
    
    /**
     * Compare two values
     *
     * @param mixed $a
     * @param mixed $b
     *
     * @return int
     */
    public function compare(mixed $a, mixed $b): int;
    
    /**
     * Returns the order
     *
     * @return string
     */
    public function getOrder(): string;
}