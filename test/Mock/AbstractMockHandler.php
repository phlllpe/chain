<?php

namespace Test\Mock;

use Chain\AbstractHandler;
use Chain\ContextInterface;

abstract class AbstractMockHandler extends AbstractHandler
{
    public function handle(ContextInterface $context)
    {
        $sequence = $context->get('sequence') ?? [];

        array_push($sequence, static::class);
        $context->set('sequence', $sequence);

        parent::handle($context);
    }
}