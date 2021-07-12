<?php

namespace Tests\Unit\Security\Authenticator;

use Codeception\Test\Unit;
use DateTime;
use Exception;
use RusLan\ResolveTest\Balance\AppBundle\Model\User\Entity\User;
use RusLan\ResolveTest\Balance\AppBundle\Model\User\Entity\UserToken;
use RusLan\ResolveTest\Balance\AppBundle\Provider\User\UserProvider;
use RusLan\ResolveTest\Balance\AppBundle\Provider\UserToken\UserTokenProvider;
use RusLan\ResolveTest\Balance\AppBundle\Security\Authenticator\AccessTokenAuthenticator;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;

/**
 * @internal
 */
class AccessTokenAuthenticatorTest extends Unit
{
    private const ACCESS_TOKEN_KEY = 'Authorization';

    /** @var AccessTokenAuthenticator */
    private $authenticator;

    /**
     * @test
     */
    public function shouldSupport(): void
    {
        $request = new Request();
        $request->attributes->set('_token', 'token');

        self::assertTrue(
            $this->authenticator->supports($request)
        );
    }

    /**
     * @test
     */
    public function shouldNotSupport(): void
    {
        $request = new Request();

        self::assertFalse(
            $this->authenticator->supports($request)
        );
    }

    /**
     * @test
     */
    public function getCredentialsWithCorrectToken(): void
    {
        $request = new Request();
        $request->attributes->set('_token', 'token');

        self::assertEquals(
            'token',
            $this->authenticator->getCredentials($request)
        );
    }

    /**
     * @test
     */
    public function getCredentialsWithIncorrectToken(): void
    {
        $request = new Request();
        $request->headers->add([self::ACCESS_TOKEN_KEY => 'token']);

        self::assertNull(
            $this->authenticator->getCredentials($request)
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function getUserWithCorrectCredentials(): void
    {
        $userProvider = $this->make(EntityUserProvider::class, []);

        self::assertInstanceOf(
            User::class,
            $this->authenticator->getUser('valid', $userProvider)
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function getUserWithIncorrectCredentials(): void
    {
        $userProvider = $this->make(EntityUserProvider::class, []);

        self::assertNull(
            $this->authenticator->getUser('invalid', $userProvider)
        );
    }

    /**
     * @test
     */
    public function checkCredentialsWithValidToken(): void
    {
        self::assertTrue(
            $this->authenticator->checkCredentials('valid', new User())
        );
    }

    /**
     * @test
     */
    public function checkCredentialsWithInvalidToken(): void
    {
        self::assertFalse(
            $this->authenticator->checkCredentials('invalid', new User())
        );
    }

    /**
     * @test
     */
    public function checkCredentialsWithExpiredToken(): void
    {
        self::assertFalse(
            $this->authenticator->checkCredentials('expired', new User())
        );
    }

    /**
     * @throws Exception
     */
    protected function _before(): void
    {
        /** @var MockObject|Translator $translator */
        $translator = $this->make(Translator::class, []);

        /** @var MockObject|UserTokenProvider $userTokenProvider */
        $userTokenProvider = $this->make(UserTokenProvider::class, [
            'findOneByAccessToken' => static function (string $accessToken): ?UserToken {
                if ('valid' === $accessToken) {
                    return (new UserToken())->setAccessTokenExpiresIn(
                        (new DateTime())->setTimestamp(time() + 1000)
                    );
                }

                if ('expired' === $accessToken) {
                    return (new UserToken())->setAccessTokenExpiresIn(
                        (new DateTime())->setTimestamp(time() - 1000)
                    );
                }

                return null;
            },
        ]);

        /** @var MockObject|UserProvider $userProvider */
        $userProvider = $this->make(UserProvider::class, [
            'getUserByAccessToken' => static function (string $accessToken): ?User {
                if ('valid' === $accessToken) {
                    return new User();
                }

                return null;
            },
        ]);

        $this->authenticator = (new AccessTokenAuthenticator($translator))
            ->setUserProvider($userProvider)
            ->setUserTokenProvider($userTokenProvider)
        ;
    }
}
