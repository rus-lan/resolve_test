<?php

namespace Fixture\Balance;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Fixture\FlushEntityAwareInterface;
use Fixture\FlushEntityAwareTrait;
use Generator;
use RusLan\ResolveTest\Balance\AppBundle\Doctrine\Registry\RegistryAwareInterface;
use RusLan\ResolveTest\Balance\AppBundle\Doctrine\Registry\RegistryAwareTrait;
use RusLan\ResolveTest\Balance\AppBundle\Faker\Generator\GeneratorAwareInterface;
use RusLan\ResolveTest\Balance\AppBundle\Faker\Generator\GeneratorAwareTrait;
use RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity\History;

class HistoryFixture extends Fixture implements
    FixtureGroupInterface,
    RegistryAwareInterface,
    FlushEntityAwareInterface,
    GeneratorAwareInterface
{
    use RegistryAwareTrait;
    use FlushEntityAwareTrait;
    use GeneratorAwareTrait;

    public const PREFIX = 'history_';

    /**
     * {@inheritdoc}
     */
    public static function getGroups(): array
    {
        return [
            'history',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->removeAllAndReset($this->getRegistry(), History::class, 'default');

        if (count($models = $this->getModels())) {
            foreach ($models as $name => $model) {
                $manager->persist($model);
                $this->addReference(static::PREFIX . $name, $model);
            }
            $manager->flush();
        }
    }

    /**
     * @return array|History[]
     */
    protected function getModels(): array
    {
        $result = [];

        for ($i = 1; $i <= 10; $i++) {
            $userId = $i;
            $balance = $this->getGenerator()->numberBetween(1000, 100000);
            $waste = $this->getGenerator()->numberBetween(5, 10);
            $dateStart = $this->getGenerator()->dateTimeBetween('-5 months', '-2 months');

            for ($z = 1; $z <= $waste; $z++) {
                $match = $this->getGenerator()->randomFloat(2, 100, 1000);
                $result[] = (new History())
                    ->setValue($match)
                    ->setBalance($balance -= $match)
                    ->setUserId($userId)
                    ->setCreatedAt($date = (new \DateTime($dateStart->modify('+1 day')->format('Y-m-d H:i:s'))))
                    ->setUpdatedAt($date)
                ;
            }
        }

        return $result;
    }
}
