<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM;

if (!interface_exists('\\Doctrine\\ORM\\EntityManagerInterface')) {
    return 0;
}

/**
 * @see \RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\EntityManagerAwareTrait
 */
interface EntityManagerAwareInterface
{
    public function getEntityManager(): ?\Doctrine\ORM\EntityManagerInterface;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface|null $entityManager
     *
     * @return static
     */
    public function setEntityManager(?\Doctrine\ORM\EntityManagerInterface $entityManager = null);
}
