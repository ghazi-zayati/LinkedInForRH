<?php

namespace Prototype\ConfigBundle\Controller\Auth;

use Prototype\ConfigBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Prototype\ConfigBundle\Entity\AppUser;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\Common\Collections\ArrayCollection;
use Prototype\ConfigBundle\Entity\Role;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Prototype\ConfigBundle\Exception\ApiProblemException;
use Prototype\ReferencielBundle\Entity\Referenciel;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Prototype\ConfigBundle\Exception\ValidationException;

class LoginController extends BaseController
{
    /**
     * @Rest\View(StatusCode = 200,serializerGroups={"AppUserGroup"})
     * @Rest\Post(
     *     path="/login",
     *     name="app_login_Login",
     *     options={ "method_prefix" = false }
     * )
     * @Rest\RequestParam(name="username")
     * @Rest\RequestParam(name="password")
     * @SWG\Post(
     *  tags={"Auth"},
     *  summary="user login",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array",
     * @SWG\Items(type="object",
     *  @SWG\Property(property="Token", type="string"),
     *  @SWG\Property(property="expirationDate", type="integer"),
     *  @SWG\Property(property="user", type="array" , @Model(type=AppUser::class))),
     * ) ),
     * @SWG\Response(response="404", description="Returned when  not found"),
     * )
     * @throw \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function postLoginAction(ParamFetcher $paramFetcher)
    {
        // Check username

        $userName=$paramFetcher->get('username');
        if(!$userName){
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['username'] = $message;
            return $this->createApiResponse($errors, 400);
        }

        $user = $this->getDoctrine()
            ->getRepository(AppUser::class)
            ->findOneBy(['username' => $userName]);

        if(!$user){
            $message = ApiProblem::USER_NOT_EXIST;
            $errors['user'] = $message;
            return $this->createApiResponse($errors, 400);
        }
        //$this->throwProblem($user, 404, ApiProblem::USER_NOT_EXIST);
        // Check password
        $password = $paramFetcher->get('password');

        if(!$password){
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['password'] = $message;
            return $this->createApiResponse($errors, 400);
        }
        //$this->throwProblem($password, 400, ApiProblem::FIELD_REQUIRED_IS_EMPTY);
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);
        //  var_dump($isValid, $password);die;
        if(!$isValid){
            $message = ApiProblem::WRONG_PASSWORD;
            $errors['wrong'] = $message;
            return $this->createApiResponse($errors, 400);
        }
        //$this->throwProblem($isValid, 401, ApiProblem::WRONG_PASSWORD, "===", false);

        // Check if user is enabled
        $this->throwProblem($user->getEnable(), 403, ApiProblem::DISABLED_USER);
        $userFinal = array();
        $userFinal["details"] = $user;

        $userRoles = $user->getUserRoles();
        $userFinal["ecrans"] = array();
        if ($userRoles)
            foreach ($userRoles as $userRole) {
                $userFinal['ecrans'] = @array_merge($userFinal['ecrans'], $userRole->getFrontInterfaces());
                $permissions = $userRole->getPermissions();
                foreach ($permissions as $permission) {
                    $permissionExplode = explode('_', $permission->getName());// récupération interface name :
                    if (count($permissionExplode) > 1)
                        $userFinal['roles'][$userRole->getRole()][$permissionExplode[1]][] = $permissionExplode[2];
                }
            }
        // getToken
        $token = $this->getToken($user);
        $this->currentUser = $user;
        $em = $this->getDoctrine()->getManager();
        $compteur = $user->getFirstLogin();

        $user->setFirstLogin($compteur + 1);
        $em->flush();
        $data = [
            'Token' => $token,
            'expirationDate' => $this->getParameter("jwt_token_ttl"),
            'User' => $userFinal,
            'FirstConnect' => $compteur + 1
        ];

        return $data;
    }

    /**
     * @param AppUser $user
     * @return string
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function getToken(AppUser $user)
    {
        return $this->get('lexik_jwt_authentication.encoder')
            ->encode(
                [
                    'username' => $user->getUsername()
                ]
            );
    }
}
