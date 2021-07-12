<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Balance;

interface BalanceProviderAwareInterface
{
    public function getBalanceProvider(): BalanceProvider;

    public function setBalanceProvider(BalanceProvider $balanceProvider);
}
