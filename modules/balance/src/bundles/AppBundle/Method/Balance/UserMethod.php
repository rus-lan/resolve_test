<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Method\Balance;

use RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity\History;
use RusLan\ResolveTest\Balance\AppBundle\Provider\Balance\HistoryProviderAwareInterface;
use RusLan\ResolveTest\Balance\AppBundle\Provider\Balance\HistoryProviderAwareTrait;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Required;
use Yoanm\JsonRpcParamsSymfonyValidator\Domain\MethodWithValidatedParamsInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

class UserMethod implements JsonRpcMethodInterface, MethodWithValidatedParamsInterface, HistoryProviderAwareInterface
{
    use HistoryProviderAwareTrait;

    public function apply(array $paramList = null): array
    {
        $balance = $this->getHistoryProvider()->getBalance(
            is_int($userId = $paramList['user_id'] ?? null) ? $userId : null
        );

        return ($balance instanceof History) ? [
            'value' => $balance->getBalance(),
            'update_at' => $balance->getCreatedAt(),
        ] : [];
    }

    public function getParamsConstraint(): Constraint
    {
        return new Collection([
            'user_id' => new Required([
                new Length(['min' => 1]),
            ]),
        ]);
    }
}
