<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\Registry;

if (
    !interface_exists('\\Doctrine\\Common\\Persistence\\ManagerRegistry')
    && !interface_exists('\\Doctrine\\Persistence\\ManagerRegistry')
    && !interface_exists('\\\Symfony\\Bridge\\Doctrine\\RegistryInterface')
) {
    return 0;
}

trait RegistryAwareTrait
{
    /**
     * @var \Doctrine\Common\Persistence\ManagerRegistry|\Doctrine\Persistence\ManagerRegistry|\Symfony\Bridge\Doctrine\RegistryInterface|null
     */
    protected $registry;

    /**
     * @return \Doctrine\Common\Persistence\ManagerRegistry|\Doctrine\Persistence\ManagerRegistry|\Symfony\Bridge\Doctrine\RegistryInterface|null
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @param \Doctrine\Common\Persistence\ManagerRegistry|\Doctrine\Persistence\ManagerRegistry|\Symfony\Bridge\Doctrine\RegistryInterface|null $registry
     *
     * @return static
     */
    public function setRegistry($registry = null)
    {
        $this->registry = $registry;

        return $this;
    }
}
