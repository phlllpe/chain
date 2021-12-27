<?php

namespace Test\Chain;

use Chain\AbstractHandler;
use Chain\Context;
use Chain\ContextInterface;
use Chain\Runner;
use PHPUnit\Framework\TestCase;
use Test\Mock\FiveMockHandler;
use Test\Mock\FourMockHandler;
use Test\Mock\MainMockHandler;
use Test\Mock\OneMockHandler;
use Test\Mock\SixMockHandler;
use Test\Mock\ThreeMockHandler;
use Test\Mock\TwoMockHandler;

class AbstractHandlerTest extends TestCase
{

    public function testChain()
    {
        $context = new Context();
        $main = new MainMockHandler();
        $one = new OneMockHandler();
        $two = new TwoMockHandler();
        $three = new ThreeMockHandler();

        $main
            ->setNext($one)
            ->setNext($two)
            ->setNext($three)
            ;
        (new Runner())->run($main, $context);

        $this->assertCount(4, $context->get('sequence'));
        $this->assertEquals(MainMockHandler::class, $context->get('sequence')[0]);
        $this->assertEquals(OneMockHandler::class, $context->get('sequence')[1]);
        $this->assertEquals(TwoMockHandler::class, $context->get('sequence')[2]);
        $this->assertEquals(ThreeMockHandler::class, $context->get('sequence')[3]);
    }

    public function testChainTri()
    {

        $main = new MainMockHandler();
        $one = new OneMockHandler();
        $two = new TwoMockHandler();
        $three = new ThreeMockHandler();
        $four = new FourMockHandler();
        $five = new FiveMockHandler();
        $six = new SixMockHandler();

        $one
            ->setNext($two)
            ->setNext($three);
        $four
            ->setNext($five)
            ->setNext($six)
            ->setNext($one);

        $main->setNext($four);

        $context = new Context();
        (new Runner())->run($main, $context);

        $this->assertCount(7, $context->get('sequence'));
        $this->assertEquals(MainMockHandler::class, $context->get('sequence')[0]);
        $this->assertEquals(FourMockHandler::class, $context->get('sequence')[1]);
        $this->assertEquals(FiveMockHandler::class, $context->get('sequence')[2]);
        $this->assertEquals(SixMockHandler::class, $context->get('sequence')[3]);
        $this->assertEquals(OneMockHandler::class, $context->get('sequence')[4]);
        $this->assertEquals(TwoMockHandler::class, $context->get('sequence')[5]);
        $this->assertEquals(ThreeMockHandler::class, $context->get('sequence')[6]);
    }
}
