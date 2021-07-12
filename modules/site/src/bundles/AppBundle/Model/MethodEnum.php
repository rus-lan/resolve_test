<?php

namespace RusLan\ResolveTest\Site\AppBundle\Model;

use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\History;
use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\UserBalance;

final class MethodEnum
{
    public const METHOD_USER_BALANCE = 'balance.userBalance';
    public const METHOD_HISTORY = 'balance.history';

    protected static array $choices = [
        self::METHOD_USER_BALANCE => self::METHOD_USER_BALANCE,
        self::METHOD_HISTORY => self::METHOD_HISTORY,
    ];

    protected static array $dto = [
        self::METHOD_USER_BALANCE => UserBalance::class,
        self::METHOD_HISTORY => History::class,
    ];

    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return array_values(self::$choices);
    }

    /**
     * @param string $name
     * @return string|null
     */
    public static function getDto(string $name): ?string
    {
        return self::$dto[$name] ?? null;
    }
}
