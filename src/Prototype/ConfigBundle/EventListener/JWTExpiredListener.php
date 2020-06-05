<?php

namespace Prototype\ConfigBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Prototype\ConfigBundle\Exception\ApiProblem;

/**
 * Description of JWTExpiredListener
 *
 * @author Lamine Mansouri
 */
class JWTExpiredListener {

    /**
     * @param JWTExpiredEvent $event
     */
    public function onJWTExpired(JWTExpiredEvent $event) {
        $errors = array();
        /** @var JWTAuthenticationFailureResponse */
        $response = $event->getResponse();
        $message = ApiProblem::TOKEN_JWT_EXPIRED;
        $errors['token'] = $message;
        $response->setMessage($errors);
    }

}
