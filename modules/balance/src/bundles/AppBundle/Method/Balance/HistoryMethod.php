<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Method\Balance;

use RusLan\ResolveTest\Balance\AppBundle\Provider\Balance\HistoryProviderAwareInterface;
use RusLan\ResolveTest\Balance\AppBundle\Provider\Balance\HistoryProviderAwareTrait;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;


class HistoryMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface, HistoryProviderAwareInterface
{
    use HistoryProviderAwareTrait;

    public function apply(array $paramList = null): array
    {
        $history = [];
        foreach ($this->getHistoryProvider()->getHistory(
            is_int($userId = $paramList['user_id'] ?? null) ? $userId : null,
            is_int($limit = $paramList['limit'] ?? null) ? $limit : null
        ) as $item){
            $history[] = [
                'id' => $item->getId(),
                'user_id' => $item->getUserId(),
                'value' => $item->getValue(),
                'created_at' => $item->getCreatedAt(),
            ];
        }

        return $history;
    }

    public function getParamsConstraint() : Constraint
    {
        return new Collection([
            'limit' => new Required([
                new Length(['min' => 1])
            ]),
        ]);
    }
}