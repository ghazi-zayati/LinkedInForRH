<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 04/07/18
 * Time: 01:21 م
 */

namespace Prototype\ConfigBundle\Services;

use Doctrine\ORM\EntityManager;
use Prototype\ConfigBundle\Entity\AppUser;
use Prototype\ConfigBundle\Entity\Permission;
use Prototype\ConfigBundle\Entity\Role;

class UserService
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createFirstUser()
    {
        $permissionExist = $this->entityManager->getRepository(Permission::class)->findOneBy(['name' => 'ALL']);
        if ($permissionExist) {
            $permission = $this->UpdatePermissionRole($permissionExist);
        } else {
            $permission = $this->CreatePermissionRole();
        }

        $roleExist = $this->entityManager->getRepository(Role::class)->findOneBy(['role' => 'ROLE_CYNAPSYS']);
        if ($roleExist) {
            $role = $this->UpdateUserRole($roleExist, $permission);
        } else {
            $role = $this->CreateUserRole($permission);
        }

        $userExist = $this->entityManager->getRepository('PrototypeConfigBundle:AppUser')->findOneBy(['username' => 'admin']);
        if ($userExist) {
            $this->UpdateUser($userExist, $role);
            $text = "User, role and permission updated successfully";
        } else {
            $this->CreateUser($role);
            $text = "User, role and permission created successfully";
        }
        return $text;
    }

    public function UpdateUser($userExist, $role)
    {
        $userExist->setEmail('user@user.com');
        $userExist->setNomFr('admin');
        $userExist->setUsername('admin');
        $userExist->setPlainPassword('admin');
        $userExist->setEnable(true);
        $userExist->setCreatedAt(new \DateTime());
        $userExist->setUpdatedAt(new \DateTime());
        $userExist->setCreatedBy(1);
        $userExist->setUpdatedBy(1);
        $userExist->addRole($role);

        $this->entityManager->persist($userExist);
        $this->entityManager->flush();
    }


    public function resetFirstUser(){

        $permissionExist = $this->entityManager->getRepository(Permission::class)->findOneBy(['name' => 'ALL']);
        if ($permissionExist) {
            $permission = $this->UpdatePermissionRole($permissionExist);
        } else {
            $permission = $this->CreatePermissionRole();
        }


        $roleExist = $this->entityManager->getRepository(Role::class)->findOneBy(['role' => 'ROLE_CYNAPSYS']);
        if ($roleExist) {
            $role = $this->UpdateUserRole($roleExist, $permission);
        } else {
            $role = $this->CreateUserRole($permission);
        }

        $userExist = $this->entityManager->getRepository('InmConfigBundle:AppUser')->findOneBy(['username' => 'admin']);
        if ($userExist) {
            $this->ResetUser($userExist,$role);
            $text = "User updated successfully";
        } else {
            $text = "User does not exist";
        }
        return $text;
    }


    public function ResetUser($userExist,$role)
    {
        if( $userExist->getEmail()!='user@user.com') $userExist->setEmail('user@user.com');
        $userExist->setNomFr('admin');
        if( $userExist->getUsername()!='admin') $userExist->setUsername('admin');
        $userExist->setPlainPassword('admin123');
        $userExist->setEnable(true);
        $userExist->setUpdatedAt(new \DateTime());
        $userExist->setCreatedBy(1);
        $userExist->setUpdatedBy(1);
        $userExist->removeRole($role);
        $userExist->addRole($role);


        $this->entityManager->persist($userExist);
        $this->entityManager->flush();
    }

    public function CreatePermissionRole(): Permission
    {
        $permission = new Permission();
        $permission->setPath('ALL')
            ->setPathMethod('ALL')
            ->setName('ALL');
        $permission->setCreatedAt(new \DateTime());
        $permission->setUpdatedAt(new \DateTime());
        $permission->setCreatedBy(1);
        $permission->setUpdatedBy(1);
        $this->entityManager->persist($permission);
        return $permission;
    }

    public function UpdatePermissionRole($permissionExist): Permission
    {
        $permissionExist->setPath('ALL')
            ->setPathMethod('ALL')
            ->setName('ALL');
        $permissionExist->setCreatedAt(new \DateTime());
        $permissionExist->setUpdatedAt(new \DateTime());
        $permissionExist->setCreatedBy(1);
        $permissionExist->setUpdatedBy(1);
        $this->entityManager->persist($permissionExist);

        $permission = $permissionExist;
        return $permission;
    }

    public function CreateUserRole($permission): Role
    {
            $role = new Role();
            $role->setRole('ROLE_CYNAPSYS');
            $role->setFrontInterfaces(['*']);
            $role->addPermission($permission);
            $role->setCreatedAt(new \DateTime());
            $role->setUpdatedAt(new \DateTime());
            $role->setCreatedBy(1);
            $role->setUpdatedBy(1);
            $this->entityManager->persist($role);
            return $role;
    }

    public function UpdateUserRole($roleExist, $permission): Role
    {
        $roleExist->setRole('ROLE_CYNAPSYS');
        $roleExist->setFrontInterfaces(['*']);
        $roleExist->addPermission($permission);
        $roleExist->setCreatedAt(new \DateTime());
        $roleExist->setUpdatedAt(new \DateTime());
        $roleExist->setCreatedBy(1);
        $roleExist->setUpdatedBy(1);
        $this->entityManager->persist($roleExist);

        $role = $roleExist;
        return $role;
    }

    public function CreateUser($role)
    {
        $user = new AppUser();
        $user->setEmail('user@user.com');
		$user->setNomFr('admin');
		$user->setNomAr('admin');
		$user->setPrenomAr('admin');
		$user->setPrenomFr('admin');
		$user->setUsername("admin");
		$user->setPlainPassword('admin');
		$user->setPasswordPrint('admin');
		$user->setEnable(true);
		$user->setCreatedAt(new \DateTime());
		$user->setUpdatedAt(new \DateTime());
		$user->setCreatedBy(1);
		$user->setUpdatedBy(1);

        $user->addRole($role);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function createSecondtUser()
    {
        $permission = new Permission();
        $permission->setPath('ALL2')
            ->setName('ALL2')
            ->setPathMethod('ALL2');
        $time = new \DateTime();
        $permission->setCreatedAt($time);
        $permission->setUpdatedAt($time);
        $permission->setCreatedBy(1);
        $permission->setUpdatedBy(1);
        $this->entityManager->persist($permission);
        $user = new AppUser();
        $user->setEmail('user2@user.com');
        $user->setUsername('admin2');
        $user->setPlainPassword('admin2');
        $user->setPasswordPrint('admin2');
        $user->setNomFr('admin2');
        $user->setNomAr('admin2');
        $user->setPrenomFr('admin2');
        $user->setPrenomAr('admin2');
        $user->setEnable(true);
        $user->setCreatedAt($time);
        $user->setUpdatedAt($time);
        $user->setCreatedBy(1);
        $user->setUpdatedBy(1);
        $user->addRole($this->entityManager->getReference(Role::class, 1));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
