<?php

namespace Chain;

interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;
    public function handle(ContextInterface $context);
}