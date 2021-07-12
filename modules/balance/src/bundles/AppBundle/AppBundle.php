<?php

namespace RusLan\ResolveTest\Balance\AppBundle;

use ReflectionClass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TarsyClub\Framework\PrependExtension;

class AppBundle extends Bundle
{
    private const ALIAS = 'resolve_test_balance';

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): PrependExtension
    {
        return new PrependExtension(
            (new ReflectionClass($this))->getShortName(),
            self::ALIAS
        );
    }
}
