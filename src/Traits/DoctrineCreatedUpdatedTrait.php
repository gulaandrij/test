<?php

namespace App\Traits;

use JMS\Serializer\Annotation as JMS;

/**
 * Trait DoctrineCreatedUpdatedTrait
 *
 * @package App\Traits
 */
trait DoctrineCreatedUpdatedTrait
{

    /**
     *
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime", name="published_at", nullable=false)
     * @JMS\Groups({"published_at", "dates"})
     */
    protected $publishedAt;

    /**
     *
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @JMS\Groups({"updated_at",     "dates"})
     */
    protected $updatedAt;

    /**
     * Gets triggered only on insert
     *
     * @ORM\PrePersist()
     */
    public function onPrePersist(): void
    {
        if (!$this->publishedAt) {
            $this->publishedAt = new \DateTime('now');
        }
    }

    /**
     * Gets triggered every time on update
     *
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     *
     * @return \DateTime
     */
    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    /**
     *
     * @param \DateTime $createdAt
     */
    public function setPublishedAt(\DateTime $createdAt): void
    {
        $this->publishedAt = $createdAt;
    }

    /**
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
