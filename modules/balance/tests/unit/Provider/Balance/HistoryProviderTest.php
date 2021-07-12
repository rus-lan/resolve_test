<?php

namespace Tests\Unit\Provider\Balance;

use Codeception\Test\Unit;
use Exception;
use Faker\Factory;
use Generator;
use PHPUnit\Framework\MockObject\MockObject;
use RusLan\ResolveTest\Balance\AppBundle\Doctrine\Repository\Balance\HistoryRepository;
use RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity\History;
use RusLan\ResolveTest\Balance\AppBundle\Provider\Balance\HistoryProvider;
use Tests\UnitTester;

/**
 * @internal
 */
class HistoryProviderTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @test
     * @dataProvider dataGetHistory
     */
    public function getHistory(array $expected, array $data, ?int $userId, ?int $limit)
    {
        $provider = $this->buildHistoryProvider($data);
        $this->assertEquals($expected, $provider->getHistory($userId, $limit));
    }

    /**
     * @test
     * @dataProvider dataGetBalance
     */
    public function getBalance(?History $expected, ?History $data, ?int $userId)
    {
        $provider = $this->buildHistoryProvider($data);
        $this->assertEquals($expected, $provider->getBalance($userId));
    }

    /**
     * @throws Exception
     *
     * @return Generator
     */
    public static function dataGetHistory()
    {
        $history = new History();
        $userId = (Factory::create())->numberBetween();
        $limit = (Factory::create())->numberBetween();

        yield [[], [], null, null];
        yield [[], [], $userId, null];
        yield [[], [], null, $limit];
        yield [[], [], $userId, $limit];
        yield [[$history], [$history], null, null];
        yield [[$history], [$history], $userId, null];
        yield [[$history], [$history], null, $limit];
        yield [[$history], [$history], $userId, $limit];
    }

    /**
     * @throws Exception
     *
     * @return Generator
     */
    public static function dataGetBalance()
    {
        $history = new History();
        $userId = (Factory::create())->numberBetween();

        yield [null, null, $userId];
        yield [$history, $history, $userId];
    }

    /**
     * @param mixed $data
     *
     * @throws Exception
     *
     * @return HistoryProvider|MockObject
     */
    protected function buildHistoryProvider($data): MockObject
    {
        return $this->make(HistoryProvider::class, [
            'getRepository' => $this->makeEmpty(HistoryRepository::class, [
                'findByHistory' => $data,
                'findByBalance' => $data,
            ]),
        ]);
    }
}
