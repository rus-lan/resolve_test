<?php


namespace RusLan\ResolveTest\Site\AppBundle\Model\User\DTO;


class History
{
    private ?int $id;
    private ?float $value;
    private ?int $userId;
    private ?\DateTime $createdAt;

    public function __construct(array $data = [])
    {
        $this
            ->setId($data['id'] ?? null)
            ->setValue($data['value'] ?? null)
            ->setUserId($data['user_id'] ?? null)
        ;
        $dateTime = $data['created_at'] ?? null;
        if(is_string($dateTime)){
            $this->setCreatedAt(new \DateTime($dateTime));
        }elseif (is_array($dateTime) && $dateTime['date'] ?? null && $dateTime['timezone'] ?? null) {
            $this->setCreatedAt(new \DateTime($dateTime['date'], new \DateTimeZone($dateTime['timezone'])));
        }
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
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return static
     */
    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}