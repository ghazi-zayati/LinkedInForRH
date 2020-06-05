<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 28/06/18
 * Time: 05:37 م
 */

namespace Prototype\ConfigBundle\Controller\Config;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Prototype\ConfigBundle\Controller\BaseController;
use Prototype\ConfigBundle\Entity\InterfaceEnum;
use Prototype\ConfigBundle\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class RoleController
 * @package Prototype\ConfigBundle\Controller\Config
 * controlleur qui gère la gestion des roles, ajouter et supprimer et modifier les noms ...
 */
class RoleController extends BaseController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Get(
     *     path = "/",
     *     name = "app_role_Ref",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Role"},
     *  summary="Get Role list",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */

    public function getAction()
    {
        //Get all the roles
        $roles = $this->em()->getRepository('PrototypeConfigBundle:Role')->findBy(["deleted"=>false]);
        //return 200 success response with the roles
        return $roles;
    }
    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Get(
     *     path = "/{id}",
     *     name = "app_role_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Role"},
     *  summary="Get Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="role id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function getRoleAction($id)
    {
        //Get the role
        $role = $this->em()->getRepository('PrototypeConfigBundle:Role')->find($id);
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
        //return 200 success response with the role
        return $role;
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"RoleGroup"})
     * @Rest\Post(
     *     path = "/new",
     *     name = "app_role_Add",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add new role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="role ",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=Role::class))
     * ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @Rest\RequestParam(name="role")
     * @Rest\RequestParam(name="front_interfaces")
     */
    public function postAddAction(ParamFetcher $paramFetcher)
    {
        //Check if the role already exist to enforce the unique constraint for the role attribute. Return 409 response
        $role = $this->em()->getRepository(Role::class)->findBy(["role" =>                                         $paramFetcher->get('role')]);
        $this->throwProblem(!$role, 409, ApiProblem::ROLE_ALREADY_EXIST);
        $role = new Role();
        //Set role parameter to role attribute
        $role->setRole($paramFetcher->get('role'));
        $role->setFrontInterfaces($paramFetcher->get('front_interfaces'));
        //Persist the role in the database
      //  $this->tryPersist($role);
        $this->em()->persist($role);
        $this->em()->flush();
        //return 200 success response with the created role
        return $this->createApiResponse($role, 201);

    }

    /**
     * @Rest\View(StatusCode = 202, serializerGroups={"RoleGroup"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_role_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Role"},
     *  summary="update role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="id role ",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="role ",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=Role::class))
     * ),
     * @SWG\Response(response="201", description="Returned when Resource updateded",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data update"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @Rest\RequestParam(name="role")
     * @Rest\RequestParam(name="front_interfaces")
     */
    public function putAction(ParamFetcher $paramFetcher, $id)
    {
        $role = $this->em()->getRepository('PrototypeConfigBundle:Role')->find($id);
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);

        //Check if the role already exist to enforce the unique constraint for the role attribute. Return 409 response
        $rolewithlabel = $this->em()->getRepository('PrototypeConfigBundle:Role')->findBy(array("role" => $paramFetcher->get('role')));
        if ((count($rolewithlabel) > 0) && (!($rolewithlabel[0]->getId() == $id))) {
            return $this->createApiResponse("Role already exists", 409);
        }

        //Set role parameter to role attribute
        $role->setRole($paramFetcher->get('role'));
        $role->setFrontInterfaces($paramFetcher->get('front_interfaces'));

        //Check if the permission parameters are set and affect them to the role.
        /*$role->setPermissions(new ArrayCollection());
        $permissions = $paramFetcher->get('permissions');
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $role->addPermission($this->em()->getReference('GboConfigBundle:Permission', $permission));
            }
        }*/

        //Persist the role in the database
        $this->tryPersist($role);

        //return 200 success response with the modified role
        return $this->createApiResponse($role, 202);
    }

    /**
    * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_role_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="200", description="Returned when deleted successful"),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function deleteAction($id)
    {
        $role =$this->em()->getRepository('PrototypeConfigBundle:Role')->find($id);
        //Check if the role exist. Return 404 if not.
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
        //Remove the role from the database
      //  $this->em()->remove($role);
       $this->desactiveentity($role);

        //return 200 success response with all the roles
        $roles =$this->em()->getRepository('PrototypeConfigBundle:Role')->findAll();
        return $roles ;
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"RoleGroup"})
     * @Rest\Post(
     *     path = "/give_permission/{id_role}/{id_permission}",
     *     name = "app_role_AddPermission",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add permission to role  role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     required=true,
     *     description=" id role",
     *    type="integer"
     *     ),
     * @SWG\Parameter(
     *     name="id_permission",
     *     in="path",
     *     description="id permission",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function postAffectPermissionAction($id_role, $id_permission)
    {
        //Get a reference to the role and the permission
        $role = $this->em()->getReference('PrototypeConfigBundle:Role', $id_role);
        $permission = $this->em()->getReference('PrototypeConfigBundle:Permission',                        $id_permission);
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
        //Check if the permission exist. Return 404 if not.
        $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);

        //Add the permission to the role and persist it to the database.
        $role->addPermission($permission);
        $this->tryPersist($role);

        //return 200 success response with the role
        return $role;
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"RoleGroup"})
     * @Rest\Post(
     *     path = "/give_permissions_to_role/",
     *     name = "app_role_AddPermissions",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add permission to role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     *
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     required=true,
     *     description=" id role",
     *    type="integer"
     *     ),
     * @SWG\Parameter(
     *     name="id_permissions",
     *     in="path",
     *     description="array of id permission",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function postAffectPermissionsAction(Request $request)
    {
        $id_role = $request->get('id_role');
        $ids_permissions = $request->get('id_permissions');
        //Get a reference to the role and the permission
        $role = $this->em()->getRepository(Role::class)->find($id_role);
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
        $LastPermissions = $role->getPermissions($id_role);
        // delete all last permissions affected
        foreach ($LastPermissions as $lastpermission) {
            $role->removePermission($lastpermission);
        }
        foreach ($ids_permissions as $id) {
            //Check if the permission exist. Return 404 if not.
            $permission = $this->em()->getRepository('PrototypeConfigBundle:Permission')->find($id);
            $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);
            //Add the permission to the role and persist it to the database.
            $role->addPermission($permission);
        }
        $this->tryPersist($role);

        //return 200 success response with the role
        return $role;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/remove_permission/{id_role}/{id_permission}",
     *     name = "app_role_DeletePermission",
     *     options={ "method_prefix" = false }
     *
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete Permission from Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Parameter(
     *     name="id_permission",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     *
     */
    public function deletePermissionRoleAction($id_role, $id_permission)
    {
        //Get a reference to the role and the permission
        $role = $this->em()->getReference('PrototypeConfigBundle:Role', $id_role);
        $permission = $this->em()->getReference('PrototypeConfigBundle:Permission',                         $id_permission);
        //Check if the role exist. Return 404 if not.
        $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
        //Check if the permission exist. Return 404 if not.
        $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);
        //Remove the permission from the role and persist it to the database.
        $role->removePermission($permission);
        $this->tryPersist($role);
        //return 200 success response with the role
        return $role;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/roles",
     *     name="app_roles_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete multiple roles",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *@Rest\RequestParam(name="ids")
     */
    public function deleteUsersAction(Request $request)
    {    $ids = $request->get("ids");
        foreach($ids as $id ) {
            $role = $this->em()->getRepository('PrototypeConfigBundle:Role')->find($id);
            //Check if the user exist. Return 404 if not.
            if ($role === null) {
                return $this->createApiResponse("role not found", 404);
            }
            $this->desactiveentity($role);
        }
        //Remove the role from the database
        //return 200 success response with all the users
        $roles = $this->em()->getRepository('PrototypeConfigBundle:Role')->findBy(["deleted"=>false]);
        return $this->createApiResponse($roles, 200);
    }
}
