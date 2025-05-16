<?php

declare(strict_types=1);

namespace LemonProject\SortedList\Handlers;

use LemonProject\SortedList\Comparators\Comparator;
use LemonProject\SortedList\LinkedList;

/**
 * SortLinkedListHandler class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class SortLinkedListHandler
{
    /**
     * SortLinkedListHandler constructor
     *
     * @param Comparator $comparator
     * @param LinkedList $list
     */
    public function __construct(protected Comparator $comparator, protected LinkedList $list) {}
    
    /**
     * Sorts the linked list
     *
     * @return void
     */
    public function sort(): void
    {
        $head = $this->list->getHead();
        
        if ($head === null || $head->getNext() === null) {
            
            return;
        }
        
        $current = $head->getNext();
        
        while ($current !== null) {
            $keyNode     = $current;
            $compareNode = $head;
            
            while ($compareNode !== $keyNode) {
                if ($this->compare($keyNode->getValue(), $compareNode->getValue()) < 0) {
                    // Swap values using getters/setters
                    $temp = $keyNode->getValue();
                    $keyNode->setValue($compareNode->getValue());
                    $compareNode->setValue($temp);
                }
                
                $compareNode = $compareNode->getNext();
            }
            
            $current = $current->getNext();
        }
    }
    
    /**
     * Returns the order of the comparator
     *
     * @return string
     */
    public function getOrder(): string
    {
        return $this->comparator->getOrder();
    }
    
    
    /**
     * Compares two values based on declared comparator
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    protected function compare($a, $b): int
    {
        return $this->comparator->compare($a, $b);
    }
}