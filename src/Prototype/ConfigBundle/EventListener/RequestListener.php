<?php

namespace Prototype\ConfigBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Prototype\ConfigBundle\Entity\AppUser;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class RequestListener
{
    private $tokenStorage;
    private $em;
    private $container;


    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager,
        Container $container
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $path = $event->getRequest()->get('_route');
		//exit($path);
//        if($_SERVER['SERVER_NAME']!==$this->container->getParameter('base_url'))  {
//            echo'Merci de vérifier votre base_url,
//                 Merci de me supprimer aprés le test'; exit;}
           // echo stripos($path,"drupal",4).'ttt'; exit;
        if ($path == "api_user_login" || $path == "Prototype_config_homepage" || $path == "nelmio_api_doc.swagger_ui" || $path == null || stripos($path,"drupal",4))
             return;
        if ($this->tokenStorage->getToken() != null && $this->tokenStorage->getToken()->getUser() != "anon.") {
            $user = $this->tokenStorage->getToken()->getUser();
            $roles = $user->getUserRoles();
            $roleName = '';
            return;
            /*foreach ($roles as $role){
                if($role->getRole()=="ROLE_CYNAPSYS") {
                     return;
                     break;
                }else{
                    $roleName=$role->getRole();
                }
            }*/
            $hasPermissions = $this->em->getRepository(AppUser::class)->hasPermissionsFunctions($path,           $user);
            $filter = $this->em
                ->getFilters()
                ->enable('filter_permissions');
            $filter->setParameter('user', $user->getId());
            $filter->setParameter('role', $roleName);
            if (!$hasPermissions) {
                $data = [
                    'code' => 403,
                    'message' => ApiProblem::PERMISSION_DENIDED
                ];
                $event->setResponse(new JsonResponse($data, 403));
            }
        }
        return;
    }
}
