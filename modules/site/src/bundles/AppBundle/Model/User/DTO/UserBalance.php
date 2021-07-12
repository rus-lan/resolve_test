<?php


namespace RusLan\ResolveTest\Site\AppBundle\Model\User\DTO;


class UserBalance
{
    private ?float $value;
    private ?\DateTime $updateAt;

    public function __construct(array $data = [])
    {
        $this
            ->setValue($data['value'] ?? null)
        ;

        $dateTime = $data['update_at'] ?? null;
        if(is_string($dateTime)){
            $this->setUpdateAt(new \DateTime($dateTime));
        }elseif (is_array($dateTime) && $dateTime['date'] ?? null && $dateTime['timezone'] ?? null) {
            $this->setUpdateAt(new \DateTime($dateTime['date'], new \DateTimeZone($dateTime['timezone'])));
        }
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
    public function getUpdateAt(): ?\DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime|null $updateAt
     * @return static
     */
    public function setUpdateAt(?\DateTime $updateAt): self
    {
        $this->updateAt = $updateAt;
        return $this;
    }
}