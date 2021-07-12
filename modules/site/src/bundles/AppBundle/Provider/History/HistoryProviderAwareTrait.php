<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\History;

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
