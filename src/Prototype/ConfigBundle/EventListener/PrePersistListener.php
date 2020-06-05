<?php

namespace Prototype\ConfigBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\Common\EventSubscriber;

class PrePersistListener implements EventSubscriber
{

    /**
     * @var Container
     */
    private $container;

    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * PrePersist
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $token =$this->container->get('security.token_storage')->getToken();
        if (!$token) {
            return;
        }

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

		if( $user == "anon."){
			return;
		}

        if (!$entity->getCreatedBy()) {

            $entity->setCreatedBy($user->getId());
            $entity->setCreatedAt(new \DateTime());
            $entity->setDeletedBy(null);
            $entity->setDeletedAt(null);
        }
        $entity->setUpdatedBy($user->getId());
        $entity->setUpdatedAt(new \DateTime());
        if($entity->getDeletedAt()){
            $entity->setDeletedBy($user->getId());
        }
        // @ revoir le concept de deleted by !
    }
    public function getSubscribedEvents()
    {
        return array(
            'prePersist'
        );
    }
}
