# CHAIN OF RESPONSABILITY
___

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phlllpe/chain/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/phlllpe/chain/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/phlllpe/chain/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/phlllpe/chain/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/phlllpe/chain/badges/build.png?b=main)](https://scrutinizer-ci.com/g/phlllpe/chain/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/phlllpe/chain/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

___

## HOW TO INSTALL
```bash
composer req phlllpe/chain
```

## USAGE

- Create a Handlers, example:

```php
namespace Any\Handler;

use Chain\AbstractHandler;
use Chain\ContextInterface;

class MyHandler extends AbstractHandler 
{
    public function handle(ContextInterface $context)
    {
        // TO DO ANY ACTION HERE, WITH ANY TEST
        if ($context->get('any') == 'HERE') {
            $context->set('myClass', static::class);
        }
        
        return parent::handle($context);
    }
}
```

- Define a sequence to setup/analyse your context with your handlers;

```php

namespace Any\Service;

use Chain\Context;
use Any\Handler\{
    MainHandler,
    AddressHandler,
    BudgetHandler,
    FamilyHandler
};

class MyService
{

    public function __invoke()
    {
        $context = new Context();
        $context->set('name', 'Philipe Fernandes');
        
        $mainHandler = new MainHandler();
        $addressHandler = new AddressHandler();
        $budgetHandler = new BudgetHandler();
        $familyHandler = new FamilyHandler();
    
        $mainHandler
            ->setNext($addressHandler)
            ->setNext($budgetHandler)
            ->setNext($familyHandler)
            
        (new Runner())->run($mainHandler, $context);
    }
}

```