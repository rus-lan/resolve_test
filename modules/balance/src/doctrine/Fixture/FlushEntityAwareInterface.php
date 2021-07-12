<?php

namespace Fixture;

use Doctrine\Common\Persistence\ManagerRegistry;

interface FlushEntityAwareInterface
{
    /**
     * @param ManagerRegistry $registry
     * @param string $class
     * @param string|null $managerName
     */
    public function removeAllAndReset($registry, string $class, string $managerName = null): void;
}
