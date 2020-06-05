<?php

namespace Prototype\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Permission
 *
 * @ORM\Table(name="permission")
 * @ORM\Entity(repositoryClass="Prototype\ConfigBundle\Repository\PermissionRepository")
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Cette permission existe déjà."
 * )
 * @Serializer\ExclusionPolicy("ALL")
 */
class Permission
{
    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"PermissionGroup","RoleGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Serializer\Groups({"PermissionGroup","RoleGroup"})
     * @Serializer\Expose()
     */
    private $name;
    /**
     *
     * @var string
     * @ORM\Column(name="path", type="string", length=255)
     * @Serializer\Groups({"PermissionGroup"})
     * @Serializer\Expose()
     */
    private $path;

    /**
     * @var string
     * @ORM\Column(name="path_method", type="string", length=255)
     * @Serializer\Groups({"PermissionGroup"})
     * @Serializer\Expose()
     */
    private $pathMethod;

    /**
     * @var \Doctrine\Common\Collections\Collection|Role[]
     * @ORM\ManyToMany(targetEntity="Prototype\ConfigBundle\Entity\Role" , mappedBy="permissions")
     * @Serializer\Groups({"PermissionGroup"})
     * @Serializer\Expose()
     */
    private $roles;



    /**
     * Default constructor, initializes collections
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }



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
     * Set interface.
     *
     * @param string $path
     *
     * @return Permission
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get interface.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set interface.
     *
     * @param string $pathMethod
     *
     * @return Permission
     */
    public function setPathMethod($pathMethod)
    {
        $this->pathMethod = $pathMethod;

        return $this;
    }

    /**
     * Get interface.
     *
     * @return string
     */
    public function getPathMethod()
    {
        return $this->pathMethod;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Role[] $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if ($this->roles->contains($role)) {
            return;
        }
        $this->roles->add($role);
        $role->addPermission($this);
    }
    /**
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        if (!$this->roles->contains($role)) {
            return;
        }
        $this->roles->removeElement($role);
        $role->removePermission($this);
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Permission
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
