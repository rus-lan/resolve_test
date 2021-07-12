<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Provider\Balance;

interface HistoryProviderAwareInterface
{
    public function getHistoryProvider(): HistoryProvider;

    public function setHistoryProvider(HistoryProvider $historyProvider);
}
