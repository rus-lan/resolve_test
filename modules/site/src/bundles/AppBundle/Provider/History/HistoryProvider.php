<?php

namespace RusLan\ResolveTest\Site\AppBundle\Provider\History;

use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\History;
use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\User;
use RusLan\ResolveTest\Site\AppBundle\Provider\Client\ClientProviderAwareInterface;
use RusLan\ResolveTest\Site\AppBundle\Provider\Client\ClientProviderAwareTrait;

class HistoryProvider implements ClientProviderAwareInterface
{
    use ClientProviderAwareTrait;

    public function create(array $option = []): History
    {
        return new History($option);
    }

    /**
     * @param User|null $user
     * @param int $limit
     *
     * @return History[]
     */
    public function get(?User $user, int $limit): array
    {
        $data = [];

        foreach ($this->getClientProvider()->fetch('balance.history', 2, [
            'limit' => $limit,
        ])['result'] ?? [] as $item) {
            $data[] = $this->create($item);
        }

        return $data;
    }
}
