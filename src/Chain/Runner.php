<?php

namespace Chain;

class Runner
{
    public function run(HandlerInterface $handler, ContextInterface $context): void
    {
        $handler->handle($context);
    }
}