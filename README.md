# Scope

> Implement a library providing SortedLinkedList (linked list that keeps values sorted).
> It should be able to hold string or int values, but not both. 
> Try to think about what you'd expect from such library as a user in terms of usability and best practices, and apply those.


# Solution

The goal of this project is:
> Implement a library providing SortedLinkedList (linked list that keeps values sorted).

The most important are 2 parts of the scope:
> It should be able to hold string or int values, but not both. 
and
> Try to think about what you'd expect from such library as a user in terms of usability and best practices, and apply those.

They decide the design of the library. From 1 side library should be useful and from other side it should prevent user from using it in a wrong way (datatype mismatch).

To meet these expectations, but at the same time not to break the single class responsibility principle, 3 basic elements were built:
- `Node` class as container for values
- `LinkedList` class list as a container for nodes and main class which provides the interface for the user
- `SortLinkedListHandler` class as a handler for the sorting of the list and the type of values in the list

It allowed to validate teh types outside class which is responsible for the sorting and allowed to decorate main class with helpful methods.

# Usage

### Linked List Class

Class can be instantiated for int or string values. It is possible by injecting correct Validator class to the constructor: 
```php
$validator = new IntegerValidator();
$list = new LinkedList($validator);
```
or
```php
$validator = new StringValidator();
$list = new LinkedList($validator);
```

Also is possible to use late binding and declare the type:
```php
$list = LinkedList::asIntegerList();
```
or
```php
$list = LinkedList::asStringList();
```

Values can be added to the list using `add` method:
```php
$list->add(1);
$list->add(2);
$list->add(3);
$list->add(3);

$list->toArray(); // [1, 2, 3, 3]
```
or
```php
$list->add('a');
$list->add('b');
$list->add('c');

$list->toArray(); // ['a', 'b', 'c']
```

Adding other types of values will throw an exception `InvalidValueTypeException`.

Also is possible to add unique values to the list:
```php
$list->addUnique(1); // true
$list->addUnique(2); // true
$list->addUnique(1); // false

$list->toArray(); // [1, 2]
```

---

### Sort Linked List Handler Class

Class can be instantiated for Ascending or Descending sorting. It is possible by injecting correct Comparator class to the constructor: 
```php
$validator = new StringValidator();
$list = new LinkedList($validator);

$comparator = new AscendingComparator();

$handler = new SortLinkedListHandler($comparator, $list);
```
`LinkedList` class validates the type of values, so `SortLinkedListHandler` class is not responsible for that. It is only responsible for sorting the list.

Most easy way to sort the list is to use `sort` method:
```php
$list = LinkedList::asStringList();

$list->add('b');
$list->add('a');
$list->add('c');

$list->sortAsc();

$list->toArray(); // ['a', 'b', 'c']
```
or
```php
$list = LinkedList::asIntegerList();

$list->add(2);
$list->add(1);
$list->add(3);

$list->sortDesc();

$list->toArray(); // [3, 2, 1]
```

---
### Node Class
`Node` class is Double Linked List node. It stores the value and the pointers to the next and previous nodes. It is used by `LinkedList` class to store the values in the list.

Allowed methods:
- `getValue` - get the value of the node
- `setValue` - set the value of the node
- `getNext` - get the next node
- `setNext` - set the next node
- `getPrev` - get the previous node
- `setPrev` - set the previous node

---
## Linked List Class Methods

### Late Bindings Methods
- `asIntegerList` - binds instance for integers
- `asStringList` - binds instance for strings
- `withNew` - binds instance for a new type

### Getters and Setters
- `getHead` - returns the head node
- `setHead` - sets the head node after validating

### Public Methods
- `add` - creates a new node and adds it to the end of list.
- `addUnique` - creates a new node and adds it to the end of list if it does not exist.
- `push` - adds a node to the end of the list.
- `delete` - removes a node from the list using the value.
- `unset` - unsets the node from the list
- `validate` - validates the value using the validator
- `getFirst` - returns the first node in the list
- `getLast` - returns the last node in the list
- `find` - finds the node in the list by value
- `exists` - checks if the list contains a value
- `sortAsc` - sorts the list in ascending order
- `sortDesc` - sorts the list in descending order
- `sort` - sorts the list using the given order
- `toArray` - returns the list as an array