<?php

namespace Chain;

use ArrayObject;

class Context implements ContextInterface
{
    private ArrayObject $collection;

    public function __construct()
    {
        $this->collection = new ArrayObject();
    }

    public function get(string $key)
    {
        return $this->has($key) ? $this->collection->offsetGet($key) : null;
    }

    public function set(string $key, $value): void
    {
        $this->collection->offsetSet($key, $value);
    }

    public function has(string $key): bool
    {
        return $this->collection->offsetExists($key);
    }
}