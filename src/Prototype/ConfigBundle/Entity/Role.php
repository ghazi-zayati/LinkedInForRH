<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 28/06/18
 * Time: 05:38 م
 */

namespace Prototype\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Prototype\ConfigBundle\Repository\RoleRepository")
 * @ORM\Table(name="roles")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Role
{
    use AbstractEntity;

    /**
     * @var
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"DeserializeUserGroup", "RoleGroup","AppUserGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     * @Serializer\Groups({"RoleGroup","AppUserGroup"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ role est obligatoire")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection|Permission[]
     * @ORM\ManyToMany(targetEntity="Prototype\ConfigBundle\Entity\Permission", inversedBy="roles")
     * @ORM\JoinTable(
     *  name="role_permission",
     *  joinColumns={
     *      @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *     @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $permissions;

    /**
     * @var \Doctrine\Common\Collections\Collection|AppUser[]
     * @ORM\ManyToMany(targetEntity="Prototype\ConfigBundle\Entity\AppUser" , mappedBy="userRoles")
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $users;
    /**
     * @var ArrayCollection
     * @ORM\Column(name="front_interfaces", type="array")
     * @Serializer\Groups({"RoleGroup"})
     * @Assert\NotBlank(message="Le champ interfaces est obligatoire")
     * @Serializer\Expose()
     */
    private $frontInterfaces;


    /**
     * Default constructor, initializes collections
     */
    public function __construct()
    {
        $this->permissions = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->frontInterfaces = new ArrayCollection();
    }
    /**
     * @return ArrayCollection
     */
    public function getFrontInterfaces()
    {
        return $this->frontInterfaces;
    }

    /**
     * @param ArrayCollection $frontInterfaces
     */
    public function setFrontInterfaces($frontInterfaces)
    {
        $this->frontInterfaces = $frontInterfaces;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Permission[] $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param Permission $permission
     */
    public function addPermission(Permission $permission)
    {
        if ($this->permissions->contains($permission)) {
            return;
        }
        $this->permissions->add($permission);
        $permission->addRole($this);
    }

    /**
     * @param Permission $permission
     */
    public function removePermission(Permission $permission)
    {
        if (!$this->permissions->contains($permission)) {
            return;
        }
        $this->permissions->removeElement($permission);
        $permission->removeRole($this);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|AppUser[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|AppUser[] $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param AppUser $user
     */
    public function addUser(AppUser $user)
    {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
        $user->addRole($this);
    }

    /**
     * @param Permission $permission
     */
    public function removeUser(AppUser $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }
        $this->users->removeElement($user);
        $user->removeRole($this);
    }
}
