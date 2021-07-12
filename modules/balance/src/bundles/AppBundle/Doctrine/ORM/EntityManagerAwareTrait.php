<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM;

if (!interface_exists('\\Doctrine\\ORM\\EntityManagerInterface')) {
    return 0;
}

/**
 * @see \RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\EntityManagerAwareInterface
 */
trait EntityManagerAwareTrait
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface|null
     */
    protected $entityManager;

    public function getEntityManager(): ?\Doctrine\ORM\EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface|null $entityManager
     *
     * @return static
     */
    public function setEntityManager(?\Doctrine\ORM\EntityManagerInterface $entityManager = null)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
