<?php

namespace Prototype\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;

/**
 * ResetPassword
 *
 * @ORM\Table(name="reset_password")
 * @ORM\Entity(repositoryClass="Prototype\ConfigBundle\Repository\ResetPasswordRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class ResetPassword
{



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"PasswordGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var $user
     * @Type("Prototype\ConfigBundle\Entity\AppUser")
     * @ORM\ManyToOne(targetEntity="Prototype\ConfigBundle\Entity\AppUser",inversedBy="tokenReset")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     * @Serializer\Groups({"PasswordGroup"})
     * @Serializer\Expose()
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateExpiration", type="string")
     * @Serializer\Groups({"PasswordGroup"})
     * @Serializer\Expose()
     */
    private $dateExpiration;

    /**
     * @var bool
     *
     * @ORM\Column(name="Validate", type="boolean")
     * @Serializer\Groups({"PasswordGroup"})
     * @Serializer\Expose()
     */
    private $validate;

    /**
     * @var string
     *
     * @ORM\Column(name="Token", type="string", length=255, unique=true)
     * @Serializer\Groups({"PasswordGroup"})
     * @Serializer\Expose()
     */
    private $token;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * Set dateExpiration.
     *
     * @param \DateTime $dateExpiration
     *
     * @return ResetPassword
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration.
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    /**
     * Set validate.
     *
     * @param bool $validate
     *
     * @return ResetPassword
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get validate.
     *
     * @return bool
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return ResetPassword
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}
