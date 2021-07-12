<?php

namespace Tests\Unit\Provider\Balance;

use Codeception\Test\Unit;
use Exception;
use Faker\Factory;
use Generator;
use PHPUnit\Framework\MockObject\MockObject;
use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\User;
use RusLan\ResolveTest\Site\AppBundle\Model\User\DTO\UserBalance;
use RusLan\ResolveTest\Site\AppBundle\Provider\Balance\BalanceProvider;
use RusLan\ResolveTest\Site\AppBundle\Provider\Client\ClientProvider;
use Tests\UnitTester;

/**
 * @internal
 */
class BalanceProviderTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @test
     * @dataProvider dataGet
     */
    public function get(?UserBalance $expected, array $data, ?User $user)
    {
        $provider = $this->buildBalanceProvider($data);
        $this->assertEquals($expected, $provider->get($user));
    }

    /**
     * @throws Exception
     *
     * @return Generator
     */
    public static function dataGet()
    {
        yield [null, [], null];
        yield [null, [
            'result' => [],
        ], null];
        yield [new UserBalance(), [], new User()];
        yield [new UserBalance(), [
            'result' => [],
        ], (new User())->setId((Factory::create())->numberBetween())];
        yield [new UserBalance(), [
            'result' => [],
        ], new User()];
        yield [(new UserBalance())->setValue($value = (Factory::create())->randomFloat()), [
            'result' => [
                'value' => $value,
            ],
        ], new User()];
        yield [(new UserBalance())->setValue($value = (Factory::create())->randomFloat()), [
            'result' => [
                'value' => $value,
            ],
        ], (new User())->setId((Factory::create())->numberBetween())];
    }

    /**
     * @param mixed $data
     *
     * @throws Exception
     *
     * @return BalanceProvider|MockObject
     */
    protected function buildBalanceProvider($data): MockObject
    {
        return $this->make(BalanceProvider::class, [
            'getClientProvider' => $this->makeEmpty(ClientProvider::class, [
                'fetch' => $data,
            ]),
        ]);
    }
}
