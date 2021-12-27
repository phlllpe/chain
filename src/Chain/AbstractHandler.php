<?php

namespace Chain;

class AbstractHandler implements HandlerInterface
{
    private ?HandlerInterface $next;

    public function __construct()
    {
        $this->next = null;
    }

    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->next = $handler;

        return $handler;
    }

    public function handle(ContextInterface $context)
    {
        if ($this->next) {
            return $this->next->handle($context);
        }
    }
}