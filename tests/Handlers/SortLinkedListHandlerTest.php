<?php

declare(strict_types=1);


namespace Handlers;

use LemonProject\SortedList\Comparators\AscendingComparator;
use LemonProject\SortedList\Comparators\DescendingComparator;
use LemonProject\SortedList\Handlers\SortLinkedListHandler;
use LemonProject\SortedList\LinkedList;
use PHPUnit\Framework\TestCase;

/**
 * SortLinkedListHandlerTest test
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class SortLinkedListHandlerTest extends TestCase
{
    /**
     * Test sorting integers in ascending order
     *
     * @return void
     */
    public function testSortIntegersAscending(): void
    {
        $list = LinkedList::asIntegerList();
        
        $list->add(3);
        $list->add(1);
        $list->add(2);
        
        $comparator = new AscendingComparator();
        $handler    = new SortLinkedListHandler($comparator, $list);
        
        $handler->sort();
        
        $expected = [1, 2, 3];
        $actual   = $list->toArray();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test sorting integers in descending order
     *
     * @return void
     */
    public function testSortIntegersDescending(): void
    {
        $list = LinkedList::asIntegerList();
        
        $list->add(3);
        $list->add(1);
        $list->add(2);
        
        $comparator = new DescendingComparator();
        $handler    = new SortLinkedListHandler($comparator, $list);
        
        $handler->sort();
        
        $expected = [3, 2, 1];
        $actual   = $list->toArray();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test sorting strings in ascending order
     *
     * @return void
     */
    public function testStringsAscending(): void
    {
        $list = LinkedList::asStringList();
        $list->add('banana');
        $list->add('apple');
        $list->add('cherry');
        
        $comparator = new AscendingComparator();
        $handler    = new SortLinkedListHandler($comparator, $list);
        
        $handler->sort();
        
        $expected = ['apple', 'banana', 'cherry'];
        $actual = $list->toArray();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * Test sorting strings in descending order
     *
     * @return void
     */
    public function testStringsDescending(): void
    {
        $list = LinkedList::asStringList();
        $list->add('banana');
        $list->add('apple');
        $list->add('cherry');
        
        $comparator = new DescendingComparator();
        $handler    = new SortLinkedListHandler($comparator, $list);
        
        $handler->sort();
        
        $expected = ['cherry', 'banana', 'apple'];
        $actual = $list->toArray();
        
        $this->assertEquals($expected, $actual);
    }
}