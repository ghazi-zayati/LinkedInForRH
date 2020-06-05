<?php

namespace Prototype\ConfigBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends BaseController
{
    /**
     *
     * Default page
     *
     * @Rest\Route("/", name="home")
     * @Rest\Get(
     *     path = "",
     *     name = "default_ctr",
     *     options={ "method_prefix" = false }
     * )
     */
    public function indexAction()
    {
        return $this->json(
            'oks'
        );
    }
}
