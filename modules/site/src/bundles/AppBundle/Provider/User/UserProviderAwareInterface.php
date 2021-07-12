<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\User;

interface UserProviderAwareInterface
{
    public function getUserProvider(): UserProvider;

    public function setUserProvider(UserProvider $userProvider);
}
