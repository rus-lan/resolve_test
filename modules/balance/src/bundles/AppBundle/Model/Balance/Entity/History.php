<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Model\Balance\Entity;

use Gedmo\Timestampable\Traits\Timestampable as TimestampableTraits;
use Gedmo\Timestampable\Timestampable;

class History implements Timestampable
{
    use TimestampableTraits;

    private ?int $id;
    private ?float $value;
    private ?float $balance;
    private ?int $userId;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return static
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float|null $value
     * @return static
     */
    public function setValue(?float $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param float|null $balance
     * @return static
     */
    public function setBalance(?float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return static
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
}
