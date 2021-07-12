<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\History;

interface HistoryProviderAwareInterface
{
    public function getHistoryProvider(): HistoryProvider;

    public function setHistoryProvider(HistoryProvider $historyProvider);
}
