<?php

declare(strict_types=1);

namespace Comparators;

use LemonProject\SortedList\Comparators\DescendingComparator;
use PHPUnit\Framework\TestCase;

/**
 * DescendingComparatorTest test
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class DescendingComparatorTest extends TestCase
{
    /**
     * Test DescendingComparator
     *
     * @return void
     */
    public function testDescendingComparator(): void
    {
        $comparator = new DescendingComparator();

        $result = $comparator->compare(2, 1);
        
        $this->assertLessThan(0, $result);
    }
    
    /**
     * Test DescendingComparator with INF
     *
     * @return void
     */
    public function testDescendingComparatorWithInf(): void
    {
        $comparator = new DescendingComparator();

        $result = $comparator->compare(INF, 2);

        $this->assertLessThan(0, $result);
    }
    
    /**
     * Test DescendingComparator with -INF
     *
     * @return void
     */
    public function testDescendingComparatorWithNegInf(): void
    {
        $comparator = new DescendingComparator();

        $result = $comparator->compare(-INF, 2);

        $this->assertGreaterThan(0, $result);
    }
    
    /**
     * Test DescendingComparator with equal values
     *
     * @return void
     */
    public function testDescendingComparatorWithEqualValues(): void
    {
        $comparator = new DescendingComparator();

        $result = $comparator->compare(1, 1);

        $this->assertEquals(0, $result);
    }
    
    /**
     * Test DescendingComparator with string values
     *
     * @return void
     */
    public function testDescendingComparatorWithStringValues(): void
    {
        $comparator = new DescendingComparator();

        $result = $comparator->compare('apple', 'banana');
        
        $this->assertGreaterThan(0, $result);
    }
}