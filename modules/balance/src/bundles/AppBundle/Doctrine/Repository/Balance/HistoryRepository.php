<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\Repository\Balance;

use Doctrine\ORM\EntityRepository;
use RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity\History;

class HistoryRepository extends EntityRepository
{
    private const SELF_ALIAS = 't';

    public function findByHistory(?int $userId, ?int $limit, string $selfAlias = self::SELF_ALIAS): array
    {
        ($qb = $this->createQueryBuilder($selfAlias))
            ->orderBy($selfAlias . '.createdAt', 'desc')
            ->setMaxResults($limit)
        ;

        if (is_int($userId)) {
            $qb
                ->where($selfAlias . '.userId = :userId')
                ->setParameter('userId', $userId)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function findByBalance(int $userId, string $selfAlias = self::SELF_ALIAS): ?History
    {
        return $this->createQueryBuilder($selfAlias)
            ->where($selfAlias . '.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy($selfAlias . '.createdAt', 'desc')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult()
        ;
    }
}
