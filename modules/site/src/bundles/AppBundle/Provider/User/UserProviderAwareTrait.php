<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\User;

trait UserProviderAwareTrait
{
    protected UserProvider $userProvider;

    public function getUserProvider(): UserProvider
    {
        return $this->userProvider;
    }

    public function setUserProvider(UserProvider $userProvider): self
    {
        $this->userProvider = $userProvider;

        return $this;
    }
}
