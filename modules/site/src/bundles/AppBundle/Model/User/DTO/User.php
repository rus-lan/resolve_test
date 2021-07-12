<?php

namespace RusLan\ResolveTest\Site\AppBundle\Model\User\DTO;

class User
{
    private ?int $id;

    public function __construct(array $data = [])
    {
        $this->setId($data['id'] ?? null);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return static
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
