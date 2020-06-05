<?php
/**
 * Created by PhpStorm.
 * User: Nagui
 * Date: 23/12/2017
 * Time: 14:15
 */

namespace Prototype\ConfigBundle\Doctrine;

use Prototype\ConfigBundle\Entity\AppUser;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordListener implements EventSubscriber
{
    private $passwordEncoder;

    /**
     * HashPasswordListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @ORM\PrePersist
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity= $args->getEntity();
        if (!$entity instanceof AppUser) {
            return;
        }
        if ($entity->getPlainPassword()) {
            $this->encodePassword($entity);
        }
    }
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity= $args->getEntity();
        if (!$entity instanceof AppUser) {
            return;
        }
        if ($entity->getPlainPassword()) {
            $this->encodePassword($entity);
        }
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }
    /**
     * @param AppUser $entity
     */
    private function encodePassword(AppUser $entity)
    {
        $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
    }
}
