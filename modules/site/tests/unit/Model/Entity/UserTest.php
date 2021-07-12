<?php

namespace Tests\Unit\Security\Authenticator;

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use DateTime;
use Exception;
use TarsyClub\Spl\Event\Bus\DoctrineEventBus;
use RusLan\ResolveTest\Site\AppBundle\Model\User\Entity\User;
use RusLan\ResolveTest\Site\AppBundle\Provider\User\UserProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @internal
 */
class UserTest extends Unit
{
    /**
     * @param User $expected
     * @param User $user
     * @param string $token
     * @param DateTime $resetPasswordTokenExpiresIn
     *
     * @test
     * @dataProvider dataCreatePairResetPassword
     *
     * @throws Exception
     */
    public function createPairResetPassword(User $expected, User $user, string $token, DateTime $resetPasswordTokenExpiresIn): void
    {
        $userProvider = $this->buildUserProviderResetPassword($token, $resetPasswordTokenExpiresIn);
        $this->assertEquals($expected, $userProvider->createPairResetPassword($user));
    }

    /**
     * @param string $expected
     * @param User $user
     * @param string $password
     *
     * @test
     * @dataProvider dataCreatePairPasswordNew
     *
     * @throws Exception
     */
    public function createPairPasswordNew(User $expected, User $user, string $password): void
    {
        $userProvider = $this->buildUserProviderPasswordNew($password);
        $this->assertEquals($expected, $userProvider->createPairPasswordNew($user, $password));
    }

    public static function dataCreatePairResetPassword(): \Generator
    {
        $faker = \Faker\Factory::create();
        $token = $faker->md5;
        $resetPasswordTokenExpiresIn = $faker->dateTime;

        yield [
            (new User())->setResetPasswordToken($token)
                ->setResetPasswordTokenExpiresIn($resetPasswordTokenExpiresIn),
            (new User()),
            $token,
            $resetPasswordTokenExpiresIn,
        ];
    }

    public static function dataCreatePairPasswordNew(): \Generator
    {
        $faker = \Faker\Factory::create();
        $password = $faker->password;

        yield [
            (new User())->setPassword($password),
            (new User()),
            $password,
        ];
    }

    /**
     * @param string $token
     * @param DateTime $resetPasswordTokenExpiresIn
     *
     * @throws Exception
     *
     * @return MockObject
     */
    protected function buildUserProviderResetPassword(string $token, DateTime $resetPasswordTokenExpiresIn): MockObject
    {
        return $this->make(UserProvider::class, [
            'resetPasswordTokenLifetime' => 600,
            'generateToken' => $token,
            'getCalculateTokensExpiringTime' => $resetPasswordTokenExpiresIn,
            'getDoctrineEventBus' => $this->makeEmpty(DoctrineEventBus::class, [
                'firePersistEvent' => Expected::once(),
            ]),
        ]);
    }

    /**
     * @param string $password
     *
     * @throws Exception
     *
     * @return MockObject
     */
    protected function buildUserProviderPasswordNew(string $password): MockObject
    {
        return $this->make(UserProvider::class, [
            'resetPasswordTokenLifetime' => 600,
            'getPasswordEncoder' => $this->makeEmpty(UserPasswordEncoderInterface::class, [
                'encodePassword' => $password,
            ]),
            'getDoctrineEventBus' => $this->makeEmpty(DoctrineEventBus::class, [
                'firePersistEvent' => Expected::once(),
            ]),
        ]);
    }
}
