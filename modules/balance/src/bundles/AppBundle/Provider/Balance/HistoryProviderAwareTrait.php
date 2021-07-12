<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Provider\Balance;

trait HistoryProviderAwareTrait
{
    protected HistoryProvider $historyProvider;

    public function getHistoryProvider(): HistoryProvider
    {
        return $this->historyProvider;
    }

    public function setHistoryProvider(HistoryProvider $historyProvider): self
    {
        $this->historyProvider = $historyProvider;

        return $this;
    }
}
