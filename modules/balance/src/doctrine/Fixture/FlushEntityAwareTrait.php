<?php

namespace Fixture;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\Mapping\ClassMetadata;

trait FlushEntityAwareTrait
{
    private static $FLUSH_SQL_RELOAD_TEMPLATE = 'ALTER TABLE %s AUTO_INCREMENT = 1';
    private static $FLUSH_SQL_DELETE_TEMPLATE = 'DELETE IGNORE FROM %s WHERE id IS NOT NULL';

    /**
     * @param ManagerRegistry $registry
     * @param string $class
     * @param string|null $managerName
     */
    public function removeAllAndReset($registry, string $class, string $managerName = null): void
    {
        $classMetadata = $registry->getManager($managerName)->getClassMetadata($class);
        $this->remove($registry, $classMetadata);
        $this->resetId($registry, $classMetadata);
    }

    /**
     * @param ManagerRegistry $registry
     * @param ClassMetadata $classMetadata
     */
    private function remove($registry, ClassMetadata $classMetadata): void
    {
        $registry->getConnection()->exec(sprintf(
            self::$FLUSH_SQL_DELETE_TEMPLATE,
            $classMetadata->getTableName()
        ));
    }

    /**
     * @param ManagerRegistry $registry
     * @param ClassMetadata $classMetadata
     */
    private function resetId($registry, ClassMetadata $classMetadata): void
    {
        $registry->getConnection()->exec(sprintf(
            self::$FLUSH_SQL_RELOAD_TEMPLATE,
            $classMetadata->getTableName()
        ));
    }
}
