<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\User;

use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\User;

class UserProvider
{
    public function create(array $option = []): User
    {
        return new User($option);
    }

    public function find(int $userId): ?User
    {
        return $this->create(['id' => $userId]);
    }
}
