<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\Balance;

use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\User;
use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\UserBalance;
use RusLan\ResolveTest\Site\AppBundle\Provider\Client\ClientProviderAwareInterface;
use RusLan\ResolveTest\Site\AppBundle\Provider\Client\ClientProviderAwareTrait;

class BalanceProvider implements ClientProviderAwareInterface
{
    use ClientProviderAwareTrait;

    public function create(array $option = []): UserBalance
    {
        return new UserBalance($option);
    }

    public function get(?User $user): ?UserBalance
    {
        if (!($user instanceof User)) {
            return null;
        }

        $data = $this->getClientProvider()->fetch('balance.userBalance', 1, [
            'user_id' => $user->getId(),
        ]);

        return $this->create($data['result'] ?? []);
    }
}
