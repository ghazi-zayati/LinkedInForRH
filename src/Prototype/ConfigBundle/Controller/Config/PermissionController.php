<?php

namespace Prototype\ConfigBundle\Controller\Config;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Prototype\ConfigBundle\Controller\BaseController;
use Prototype\ConfigBundle\Entity\Permission;
use Doctrine\Common\Collections\ArrayCollection;
use Prototype\ConfigBundle\Services\EntityMerger;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class PermissionController extends BaseController
{
    use ControllerTrait;

    private $entityMerger;
    private $context;
    public function __construct(
        EntityMerger $entityMerger
    ) {
        $this->entityMerger = $entityMerger;
        $this->context = new SerializationContext();
        $this->context->setGroups("PermissionGroup");
    }

    /**
     * @Rest\Get(
     *     path = "/",
     *     name = "app_permission_Ref",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Permission"},
     *  summary="Gets all the permissions",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Permission::class))),
     * @SWG\Response(response="404", description="Returned when permission not found"),
     * )
     */

    public function getAction()
    {
        //Get all the permissions
        $permissions =$this->em()->getRepository('PrototypeConfigBundle:Permission')->findAll();

        //return 200 success response with the permissions
        // $resp = $this->get('jms_serializer')->serialize($permissions, 'json', SerializationContext::create()->setGroups(array('PermissionGroup')));
        return $this->createApiResponseGroup($permissions, 200, "PermissionGroup");
        // return $resp;
    }
    /**
     * @Rest\Get(
     *     path = "/{id}",
     *     name = "app_permission_Get",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Permission"},
     *  summary="Get  permission by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Permission::class))),
     * @SWG\Response(response="404", description="Returned when permission not found"),
     * )
     */
    public function getPermissionAction($id)
    {
        //Get the permission
        $permission =$this->em()->getRepository('PrototypeConfigBundle:Permission')->find($id);

        //Check if the permission exist. Return 404 if not.
        if ($permission === null) {
            return $this->createApiResponse("Permission not found", 404);
        }

        //return 200 success response with the permission
        return $this->createApiResponse($permission, 200);
    }

    /**
     * @Rest\Post(
     *     path = "/add",
     *     name = "app_permission_Add",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Permission"},
     *  summary="add new Permission",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Permission",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=Permission::class))
     * ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Permission::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * )
     * @Rest\RequestParam(name="path")
     * @Rest\RequestParam(name="pathmethod")
     */
    public function postAddAction(ParamFetcher $paramFetcher)
    {
        $permission = new Permission();
        //Set the parameters to the permission attributes
        $permission->setPath($paramFetcher->get('path'));
        $permission->setName($paramFetcher->get('path'));
        $permission->setPathMethod($paramFetcher->get('pathmethod'));

        //Persist the permission in the database
        $this->em()->persist($permission);
        $this->em()->flush();

        //return 200 success response with the created permission
        return $this->createApiResponse($permission, 200);
    }

    /**
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_permission_Edit",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Put(
     *  tags={"Permission"},
     *  summary="update Permission",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Permission",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=Permission::class))
     * ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Permission::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * )
     * @Rest\RequestParam(name="path")
     * @Rest\RequestParam(name="pathmethod")
     */
    public function putAction(ParamFetcher $paramFetcher, $id)
    {
        $permission =$this->em()->getRepository('PrototypeConfigBundle:Permission')->find($id);
        //Check if the permission exist. Return 404 if not.
        if ($permission === null) {
            return $this->createApiResponse("Permission not found", 404);
        }

        //Set the parameters to the permission attributes
        $permission->setPath($paramFetcher->get('path'));
        $permission->setName($paramFetcher->get('path'));
        $permission->setPathMethod($paramFetcher->get('pathmethod'));

        //Persist the permission in the database
        $this->em()->persist($permission);
        $this->em()->flush();

        //return 200 success response with the modified permission
        return $this->createApiResponse($permission, 200);
    }

    /**
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_permission_Delete",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Delete(
     *  tags={"Permission"},
     *  summary="delete  permission by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Permission id",
     *     type="integer",
     *     required=true
     * ),
     * @SWG\Response(response="201", description="Returned when permission deleted"),
     * @SWG\Response(response="400", description="Returned when invalid data"),
     * )
     */
    public function deleteAction($id)
    {
        $permission =$this->em()->getRepository('PrototypeConfigBundle:Permission')->find($id);
        //Check if the permission exist. Return 404 if not.
        if ($permission === null) {
            return $this->createApiResponse("Permission not found", 404);
        }

        //Remove the permission from the database
        $this->em()->remove($permission);
        $this->em()->flush();

        //return 200 success response with all the permissions
        $permissions =$this->em()->getRepository('PrototypeConfigBundle:Permission')->findAll();
        return $this->createApiResponse($permissions, 200);
    }
}
