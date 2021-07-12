<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Handler\Mapping;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodAwareInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

class MappingHandler implements JsonRpcMethodAwareInterface
{
    /** @var JsonRpcMethodInterface[] */
    private array $mappingList = [];

    public function addJsonRpcMethod(string $methodName, JsonRpcMethodInterface $method): void
    {
        $this->mappingList[$methodName] = $method;
    }

    /**
     * @return JsonRpcMethodInterface[]
     */
    public function getMappingList() : array
    {
        return $this->mappingList;
    }
}