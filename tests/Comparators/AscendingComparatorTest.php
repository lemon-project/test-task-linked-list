<?php

declare(strict_types=1);

namespace Comparators;

use LemonProject\SortedList\Comparators\AscendingComparator;
use PHPUnit\Framework\TestCase;

/**
 * AscendingComparatorTest test
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class AscendingComparatorTest extends TestCase
{
    /**
     * Test AscendingComparator
     *
     * @return void
     */
    public function testAscendingComparator(): void
    {
        $comparator = new AscendingComparator();

        $result = $comparator->compare(1, 2);

        $this->assertLessThan(0, $result);
    }
    
    /**
     * Test AscendingComparator with INF
     *
     * @return void
     */
    public function testAscendingComparatorWithInf(): void
    {
        $comparator = new AscendingComparator();

        $result = $comparator->compare(INF, 2);

        $this->assertGreaterThan(0, $result);
    }
    
    /**
     * Test AscendingComparator with -INF
     *
     * @return void
     */
    public function testAscendingComparatorWithNegInf(): void
    {
        $comparator = new AscendingComparator();

        $result = $comparator->compare(-INF, 2);

        $this->assertLessThan(0, $result);
    }
    
    /**
     * Test AscendingComparator with equal values
     *
     * @return void
     */
    public function testAscendingComparatorWithEqualValues(): void
    {
        $comparator = new AscendingComparator();

        $result = $comparator->compare(2, 2);

        $this->assertEquals(0, $result);
    }
    
    /**
     * Test AscendingComparator with string values
     *
     * @return void
     */
    public function testAscendingComparatorWithStringValues(): void
    {
        $comparator = new AscendingComparator();

        $result = $comparator->compare('apple', 'banana');
        
        $this->assertLessThan(0, $result);
    }
}