<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Provider\Balance;

use RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\RepositoryAwareInterface;
use RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\RepositoryAwareTrait;
use RusLan\ResolveTest\Balance\AppBundle\Doctrine\Repository\Balance\HistoryRepository;
use RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity\History;

/**
 * @method HistoryRepository getRepository
 */
class HistoryProvider implements RepositoryAwareInterface
{
    use RepositoryAwareTrait;

    public function create(): History
    {
        return new History();
    }

    /**
     * @param int|null $userId
     * @param int|null $limit
     *
     * @return History[]
     */
    public function getHistory(?int $userId, ?int $limit): array
    {
        return $this->getRepository()->findByHistory($userId, $limit);
    }

    public function getBalance(int $userId): ?History
    {
        return $this->getRepository()->findByBalance($userId);
    }
}
