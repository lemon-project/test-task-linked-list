<?php

declare(strict_types=1);

namespace LemonProject\SortedList;

/**
 * Node class
 *
 * @author Rafal Wachstiel <rafal.wachstiel@gmail.com>
 */
final class Node
{
    private mixed $value;
    private ?Node $prev = null;
    private ?Node $next = null;
    
    /**
     * Node constructor
     *
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }
    
    /**
     * Get the value of the node
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }
    
    /**
     * Set the value of the node
     *
     * @param mixed $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }
    
    /**
     * Get the next node
     *
     * @return Node|null
     */
    public function getNext(): ?Node
    {
        return $this->next;
    }
    
    /**
     * Set the next node
     *
     * @param Node|null $next
     */
    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }
    
    /**
     * Get the previous node
     *
     * @return Node|null
     */
    public function getPrev(): ?Node
    {
        return $this->prev;
    }
    
    /**
     * Set the previous node
     *
     * @param Node|null $prev
     */
    public function setPrev(?Node $prev): void
    {
        $this->prev = $prev;
    }
}