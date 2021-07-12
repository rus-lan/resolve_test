<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Doctrine\Registry;

if (
    !interface_exists('\\Doctrine\\Common\\Persistence\\ManagerRegistry')
    && !interface_exists('\\Doctrine\\Persistence\\ManagerRegistry')
    && !interface_exists('\\\Symfony\\Bridge\\Doctrine\\RegistryInterface')
) {
    return 0;
}

interface RegistryAwareInterface
{
    /**
     * @return \Doctrine\Common\Persistence\ManagerRegistry|\Doctrine\Persistence\ManagerRegistry|\Symfony\Bridge\Doctrine\RegistryInterface|null
     */
    public function getRegistry();

    /**
     * @param \Doctrine\Common\Persistence\ManagerRegistry|\Doctrine\Persistence\ManagerRegistry|\Symfony\Bridge\Doctrine\RegistryInterface|null $registry
     *
     * @return static
     */
    public function setRegistry($registry = null);
}
