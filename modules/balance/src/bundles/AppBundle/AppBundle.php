<?php

namespace RusLan\ResolveTest\Balance\AppBundle;

use TarsyClub\Framework\PrependExtension;
use ReflectionClass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    private const ALIAS = 'abit_lk_app';

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
