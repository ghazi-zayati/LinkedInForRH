<?php

namespace Prototype\ConfigBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Prototype\ConfigBundle\Controller\BaseController;
use Prototype\ConfigBundle\Entity\AppUser;
use Prototype\ConfigBundle\Entity\Permission;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Prototype\ConfigBundle\Exception\ApiProblemException;
//use JsonSchema\Exception\ValidationException;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Prototype\ConfigBundle\Exception\ValidationException;
//use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PermissionService extends BaseController
{
    private $router;
    private $em;
    private $tokenStorage;
    private $requestStack;

    public function __construct(//\Symfony\Bundle\FrameworkBundle\Routing\Router $router,
        RouterInterface $router,
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        RequestStack $requestStack
    )
    {
        $this->router = $router;
        $this->em = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
    }

    public function createPermissions()
    {
        $router = $this->router;
        $routes = $router->getRouteCollection();
        $methodListe = [
            'Get', 'Delete', 'Add', 'Edit', 'Pagination', 'Generate',"Import"
        ];
        foreach ($routes as $key => $value) {
            if (strpos($key, '_')) {
                if( count(explode('_', $key))==3){
                // It starts with 'http'
                $keyName = explode('_', $key);
                //dump();die();
                $method = sizeof($value->getMethods()) > 0
                    ?
                    $value->getMethods()[0]
                    : "ANY";
   if ($this->em->getRepository(Permission::class)->findOneBy(['name' => $key])!=null || $keyName[0] !== "app" || $method == "ANY" || !in_array($keyName[2], $methodListe)) continue;

                    $permission = new Permission();
                    $permission->setPath($value->getPath())
                        ->setName($key)
                        ->setPathMethod($method);
                    $time = new \DateTime();
                    $permission->setCreatedAt($time);
                    $permission->setCreatedBy(1);
                    $permission->setUpdatedAt($time);
                    $permission->setUpdatedBy(1);

                $this->em->persist($permission);
            }}
        }

        $this->em->flush();
        $text = "permissions created successfully";

        return $text;
    }

//    public function hasPermissionss($path)
//    {
//        $request = $this->requestStack->getCurrentRequest();
//        //dump($request->get('_route'));die();
//        $user = $this->tokenStorage->getToken()->getUser();
//
//        $hasPermission = $this->em->getRepository(AppUser::class)->hasPermissions($path, 'GET', $user);
//        //dump($hasPermission);die();
//        if (!$hasPermission) {
//            $apiProblem = new ApiProblem(
//                404,
//                ApiProblem::PERMISSION_DENIDED
//            );
//            throw new ApiProblemException($apiProblem);
//        }
//    }
}
