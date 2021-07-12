<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Client;

trait ClientProviderAwareTrait
{
    protected ClientProvider $clientProvider;

    public function getClientProvider(): ClientProvider
    {
        return $this->clientProvider;
    }

    public function setClientProvider(ClientProvider $clientProvider): self
    {
        $this->clientProvider = $clientProvider;

        return $this;
    }
}
