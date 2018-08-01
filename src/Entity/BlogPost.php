<?php

namespace App\Entity;

use App\Annotation\RoleAware;
use App\Traits\DoctrineCreatedUpdatedTrait;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 * @UniqueEntity(fields={"slug"})
 *
 * @ORM\HasLifecycleCallbacks()
 *
 * @RoleAware()
 */
class BlogPost
{
    use DoctrineCreatedUpdatedTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, nullable=false)
     *
     * @Assert\Length(max="60", min="3")
     * @Assert\NotBlank()
     *
     * @Serializer\Groups({"admin", "user"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=300, unique=true)
     *
     * @Required()
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     *
     * @Serializer\Groups({"admin", "user"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @Assert\Length(min="10")
     * @Assert\NotBlank()
     *
     * @Serializer\Groups({"admin", "user"})
     */
    private $content;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     * @Serializer\Groups({"admin", "user"})
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=7,options={"default":"draft"})
     *
     * @Assert\Choice(choices={"publish","draft"})
     *
     * @Serializer\Groups({"admin"})
     */
    private $status = 'draft';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}
