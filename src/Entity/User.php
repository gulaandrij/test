<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{

    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Groups("public")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Serializer\Groups({"admin", "user"})
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Serializer\Groups({"admin", "user"})
     */
    protected $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", length=100)
     */
    protected $birthDay;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDay(): \DateTime
    {
        return $this->birthDay;
    }

    /**
     * @param \DateTime $birthDay
     */
    public function setBirthDay(\DateTime $birthDay): void
    {
        $this->birthDay = $birthDay;
    }
}
