<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Balance;

trait BalanceProviderAwareTrait
{
    protected BalanceProvider $balanceProvider;

    public function getBalanceProvider(): BalanceProvider
    {
        return $this->balanceProvider;
    }

    public function setBalanceProvider(BalanceProvider $balanceProvider): self
    {
        $this->balanceProvider = $balanceProvider;

        return $this;
    }
}
