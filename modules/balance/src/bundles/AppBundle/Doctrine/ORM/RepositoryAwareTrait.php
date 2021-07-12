<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM;

if (
    !interface_exists('\\Doctrine\\Persistence\\ObjectRepository')
    || interface_exists('\\Doctrine\\Persistence\\Common\\ObjectRepository')
) {
    return 0;
}

/**
 * @see \RusLan\ResolveTest\Balance\AppBundle\Doctrine\ORM\RepositoryAwareInterface
 */
trait RepositoryAwareTrait
{
    /**
     * @var \Doctrine\Persistence\Common\ObjectRepository|\Doctrine\Persistence\ObjectRepository|null
     */
    protected $repository;

    /**
     * @return \Doctrine\Persistence\Common\ObjectRepository|\Doctrine\Persistence\ObjectRepository|null
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param \Doctrine\Persistence\Common\ObjectRepository|\Doctrine\Persistence\ObjectRepository|null $repository
     *
     * @return static
     */
    public function setRepository($repository = null)
    {
        $this->repository = $repository;

        return $this;
    }
}
