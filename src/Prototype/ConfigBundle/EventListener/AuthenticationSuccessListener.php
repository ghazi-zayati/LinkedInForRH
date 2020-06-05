<?php

namespace Prototype\ConfigBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Prototype\Services\UserService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{


    /** @var  TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface  $storage
     */
    public function __construct(TokenStorageInterface $storage)
    {
        $this->tokenStorage = $storage;
    }
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $token = $this->tokenStorage->getToken();

        /*if ($token instanceof TokenInterface) {

                ->serialize($token->getUser(), "json");
           // var_dump($storage).die;
            $data['data'] = array(
                'user' => $user

            );

            $event->setData($data);

        }*/
    }
}
