<?php

namespace Tests\Unit\Entity\Model;

use Codeception\Test\Unit;
use DateTime;
use RusLan\ResolveTest\Site\AppBundle\Model\User\Entity\UserToken;

/**
 * @internal
 */
class UserTokenTest extends Unit
{
    /**
     * @test
     */
    public function accessTokenShouldBeExpired(): void
    {
        $token = (new UserToken())->setAccessTokenExpiresIn(new DateTime('1996-11-10'));
        self::assertTrue($token->isAccessTokenExpired());
    }

    /**
     * @test
     */
    public function refreshTokenShouldBeExpired(): void
    {
        $token = (new UserToken())->setRefreshTokenExpiresIn(new DateTime('1996-11-10'));
        self::assertTrue($token->isRefreshTokenExpired());
    }

    /**
     * @test
     */
    public function accessTokenShouldNotBeExpired(): void
    {
        $token = (new UserToken())->setAccessTokenExpiresIn(
            (new DateTime())->setTimestamp(time() + 1000)
        );
        self::assertFalse($token->isAccessTokenExpired());
    }

    /**
     * @test
     */
    public function refreshTokenShouldNotBeExpired(): void
    {
        $token = (new UserToken())->setRefreshTokenExpiresIn(
            (new DateTime())->setTimestamp(time() + 1000)
        );
        self::assertFalse($token->isRefreshTokenExpired());
    }
}
