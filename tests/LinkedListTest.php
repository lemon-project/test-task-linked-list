<?php

declare(strict_types=1);


use LemonProject\SortedList\Exceptions\InvalidValueTypeException;
use LemonProject\SortedList\LinkedList;
use PHPUnit\Framework\TestCase;

/**
 * LinkedListTest test
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class LinkedListTest extends TestCase
{
    /**
     * Test adding elements to the linked list
     *
     * @return void
     */
    public function testAddIntegers(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(2);
        $list->add(1);
        $list->add(3);

        $this->assertEquals([2, 1, 3], $list->toArray());
    }
    
    /**
     * Test adding strings to the linked list
     *
     * @return void
     */
    public function testAddStrings(): void
    {
        $list = LinkedList::asStringList();
        $list->add('b');
        $list->add('a');
        $list->add('c');

        $this->assertEquals(['b', 'a', 'c'], $list->toArray());
    }
    
    /**
     * Test adding unique integers to the linked list
     *
     * @return void
     */
    public function testAddUniqueIntegers(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1, true);
        $list->add(2, true);
        $actual = $list->add(1, true); // Duplicate

        $this->assertFalse($actual);
        $this->assertEquals([1, 2], $list->toArray());
    }
    
    /**
     * Test adding floats to the linked list
     *
     * @return void
     */
    public function testAddIllegalDataType(): void
    {
        $this->expectException(InvalidValueTypeException::class);

        $list = LinkedList::asIntegerList();
        $list->add(1.23);
    }
    
    /**
     * Test adding null to the linked list
     *
     * @return void
     */
    public function testAddNull(): void
    {
        $this->expectException(InvalidValueTypeException::class);

        $list = LinkedList::asIntegerList();
        $list->add(null);
    }
    
    /**
     * Test getting elements from the linked list
     *
     * @return void
     */
    public function testDelete(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $actual = $list->delete(2);

        $this->assertTrue($actual);
        $this->assertEquals([1, 3], $list->toArray());
    }
    
    /**
     * Test deleting a non-existing element from the linked list
     *
     * @return void
     */
    public function testDeleteNonExisting(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $actual = $list->delete(4);

        $this->assertFalse($actual);
        $this->assertEquals([1, 2, 3], $list->toArray());
    }
    
    /**
     * Test getting the last element from the linked list
     *
     * @return void
     */
    public function testGetFirst(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);
        
        $first = $list->getFirst();
        $this->assertEquals(1, $first->getValue());
        
        $list->delete(1);
        $first = $list->getFirst();
        $this->assertEquals(2, $first->getValue());
        
        $list->delete(3);
        $first = $list->getFirst();
        $this->assertEquals(2, $first->getValue());
    }
    
    /**
     * Test getting the last element from the linked list
     *
     * @return void
     */
    public function testGetLast(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);
        
        $last = $list->getLast();
        $this->assertEquals(3, $last->getValue());
        
        $list->delete(3);
        $last = $list->getLast();
        $this->assertEquals(2, $last->getValue());
        
        $list->delete(1);
        $last = $list->getLast();
        $this->assertEquals(2, $last->getValue());
    }
    
    /**
     * Test finding an existing value in the linked list
     *
     * @return void
     */
    public function testFindExistingValue(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $node = $list->find(2);

        $this->assertNotNull($node);
        $this->assertEquals(2, $node->getValue());
    }
    
    /**
     * Test finding a non-existing value in the linked list
     *
     * @return void
     */
    public function testFindNonExistingValue(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $node = $list->find(4);

        $this->assertNull($node);
    }
    
    /**
     * Test checking if a value exists in the linked list
     *
     * @return void
     */
    public function testExists(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $this->assertTrue($list->exists(2));
        $this->assertFalse($list->exists(4));
    }
    
    /**
     * Test sorting the linked list in ascending order
     *
     * @return void
     */
    public function testSortAscending(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(3);
        $list->add(1);
        $list->add(2);
        
        $list->sortAsc();
        
        $this->assertEquals([1, 2, 3], $list->toArray());
    }
    
    /**
     * Test sorting the linked list in descending order
     *
     * @return void
     */
    public function testSortDescending(): void
    {
        $list = LinkedList::asIntegerList();
        $list->add(3);
        $list->add(1);
        $list->add(2);
        
        $list->sortDesc();
        
        $this->assertEquals([3, 2, 1], $list->toArray());
    }
}