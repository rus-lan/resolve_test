<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM;

if (!interface_exists('\\Doctrine\\Persistence\\ObjectRepository')) {
    return 0;
}

/**
 * @see \RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\RepositoryAwareTrait
 */
interface RepositoryAwareInterface
{
    /**
     * @return \Doctrine\Persistence\Common\ObjectRepository|\Doctrine\Persistence\ObjectRepository|null
     */
    public function getRepository();

    /**
     * @param \Doctrine\Persistence\Common\ObjectRepository|\Doctrine\Persistence\ObjectRepository|null $repository
     *
     * @return static
     */
    public function setRepository($repository = null);
}
