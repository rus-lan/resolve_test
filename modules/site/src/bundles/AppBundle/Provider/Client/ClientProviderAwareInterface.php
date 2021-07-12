<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Client;

interface ClientProviderAwareInterface
{
    public function getClientProvider(): ClientProvider;

    public function setClientProvider(ClientProvider $clientProvider);
}
