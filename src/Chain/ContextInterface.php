<?php

namespace Chain;

interface ContextInterface
{
    public function get(string $key);
    public function set(string $key, $value): void;
    public function has(string $name): bool;
}