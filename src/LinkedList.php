<?php

declare(strict_types=1);

namespace LemonProject\SortedList;

use LemonProject\SortedList\Comparators\Comparator;
use LemonProject\SortedList\Comparators\ComparatorFactory;
use LemonProject\SortedList\Handlers\SortLinkedListHandler;
use LemonProject\SortedList\Validators\Validator;
use LemonProject\SortedList\Validators\ValidatorFactory;

/**
 * LinkedList class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
class LinkedList
{
    /** @var Node|null $head Current head of the list */
    protected ?Node $head = null;
    
    /** @var SortLinkedListHandler|null $sortHandler */
    protected ?SortLinkedListHandler $sortHandler = null;
    
    /**
     * LinkedList constructor
     *
     * @param Validator $validator
     */
    public function __construct(protected Validator $validator) {}
    
    /*
    |--------------------------------------------------------------------------
    | LATE BINDING
    |--------------------------------------------------------------------------
    |
    | If DI or factory, decorator, etc. are not used, you can bind instance for integers or strings.
    | If you want to add a new type, you need to create a new validator and add it here.
    */
    
    /**
     * Binds instance for integers
     *
     * @return self
     */
    public static function asIntegerList(): self
    {
        return self::withNew(Validator::TYPE_INT);
    }
    
    /**
     * Binds instance for strings
     *
     * @return self
     */
    public static function asStringList(): self
    {
        return self::withNew(Validator::TYPE_STRING);
    }
    
    /**
     * Binds instance for a new type
     *
     * @param string $type
     *
     * @return self
     */
    public static function withNew(string $type): self
    {
        $validator = (new ValidatorFactory())->make($type);
        
        return new self($validator);
    }
    
    /*
    |--------------------------------------------------------------------------
    | GETTERS AND SETTERS
    |--------------------------------------------------------------------------
    */
    
    /**
     * Returns the head node
     *
     * @return Node|null
     */
    public function getHead(): ?Node
    {
        return $this->head;
    }
    
    /**
     * Sets the head node after validating
     *
     * @param Node $head
     *
     * @return void
     */
    public function setHead(Node $head): void
    {
        $this->validateList($head);
        
        $this->head = $head;
    }
    
    /*
    |--------------------------------------------------------------------------
    | PUBLIC METHODS
    |--------------------------------------------------------------------------
    */
    
    /**
     * Adds a new node to the end of list.
     * For now, it only allows adding integers and strings.
     * If values should be unique, set the $unique flag to true.
     *
     * @param mixed $value
     * @param bool  $unique
     *
     * @return bool
     */
    public function add(mixed $value, bool $unique = false): bool
    {
        $this->validate($value);
        
        $node    = new Node($value);
        $current = $this->getLast();
        
        if ($current === null) {
            $this->setHead($node);
            
            return true;
        }
        
        if ($unique && $this->exists($value)) {
            
            return false;
        }
        
        $current->setNext($node);
        $node->setPrev($current);
        
        return true;
    }
    
    /**
     * Removes a node from the list using the value.
     * Returns true if the node was found and removed.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function delete(mixed $value): bool
    {
        $this->validate($value);
        
        $node = $this->find($value);
        if ($node === null) {
            
            return false;
        }
        
        $prev = $node->getPrev();
        $next = $node->getNext();
        
        if ($prev !== null) {
            $prev->setNext($node->getNext());
        } else {
            $this->head = $node->getNext();
        }
        
        
        $next?->setPrev($node->getPrev());
        
        unset($node);
        
        return true;
    }
    
    /**
     * Validates the value using the validator
     *
     * @param mixed $value
     *
     * @return void
     */
    public function validate(mixed $value): void
    {
        $this->validator->validate($value);
    }
    
    /**
     * Returns the first node in the list
     *
     * @return Node|null
     */
    public function getFirst(): ?Node
    {
        $current = $this->getHead();
        
        if ($current === null) {
            
            return null;
        }
        
        while ($current->getPrev() !== null) {
            $current = $current->getPrev();
        }
        
        return $current;
    }
    
    /**
     * Returns the last node in the list
     *
     * @return Node|null
     */
    public function getLast(): ?Node
    {
        $current = $this->getHead();
        
        if ($current === null) {
            
            return null;
        }
        
        while ($current->getNext() !== null) {
            $current = $current->getNext();
        }
        
        return $current;
    }
    
    /**
     * Checks if the list contains a value
     *
     * @param mixed $value
     *
     * @return Node|null
     */
    public function find(mixed $value): ?Node
    {
        $this->validator->validate($value);
        
        $current = $this->getHead();
        
        while ($current !== null) {
            if ($current->getValue() === $value) {
                
                return $current;
            }
            $current = $current->getNext();
        }
        
        return null;
    }
    
    /**
     * Checks if the list contains a value
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function exists(mixed $value): bool
    {
        return $this->find($value) !== null;
    }
    
    /**
     * Sorts the list in ascending order
     *
     * @return void
     */
    public function sortAsc(): void
    {
        $this->sort(Comparator::ORDER_ASC);
    }
    
    /**
     * Sorts the list in descending order
     *
     * @return void
     */
    public function sortDesc(): void
    {
        $this->sort(Comparator::ORDER_DESC);
    }
    
    /**
     * Sorts the list using the given order
     *
     * @param string $order
     *
     * @return void
     */
    public function sort(string $order): void
    {
        // once declared, the sort handler can be reused if the order is the same
        if ($this->sortHandler === null || $this->sortHandler->getOrder() !== $order) {
            $this->sortHandler = new SortLinkedListHandler($this->makeComparator($order), $this);
        }
        
        $this->sortHandler->sort();
    }
    
    /**
     * Returns the list as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $result  = [];
        $current = $this->getHead();
        
        while ($current !== null) {
            $result[] = $current->getValue();
            $current  = $current->getNext();
        }
        
        return $result;
    }
    
    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */
    
    /**
     * Makes a comparator instance based on the order type
     *
     * @param string $order
     *
     * @return Comparator
     */
    protected function makeComparator(string $order): Comparator
    {
        return (new ComparatorFactory())->make($order);
    }
    
    /**
     * Validates the list
     *
     * @param Node $head
     *
     * @return void
     */
    protected function validateList(Node $head): void
    {
        $current = $head;
        
        while ($current !== null) {
            $this->validator->validate($current->getValue());
            $current = $current->getNext();
        }
    }
}