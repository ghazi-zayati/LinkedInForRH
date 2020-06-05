<?php

namespace Prototype\ReferencielBundle\Controller;

use Doctrine\DBAL\DBALException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Prototype\ConfigBundle\Controller\BaseController;
use Doctrine\Common\Collections\ArrayCollection;
use Prototype\ReferencielBundle\Entity\Referenciel;
use JMS\Serializer\SerializationContext;
use Prototype\ReferencielBundle\Services\ReferencielService;
use Nelmio\ApiDocBundle\Annotation\Model;
use FOS\RestBundle\Controller\ControllerTrait;
use Swagger\Annotations as SWG;
use Doctrine\ORM\Query\ResultSetMapping;
use Prototype\ConfigBundle\Entity\AppUser;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Prototype\ConfigBundle\Exception\ApiProblemException;
use Prototype\ConfigBundle\Exception\ValidationException;
use Prototype\ConfigBundle\Services\EntityMerger;
use Prototype\ConfigBundle\Services\PermissionService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Prototype\ReferencielBundle\Representation\Referentiels;
use Symfony\Component\HttpFoundation\Response;

class ReferencielController extends BaseController
{
    use ControllerTrait;

    private $tokenStorage;
    private $entityMerger;
    private $permissionService;
    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityMerger $entityMerger,
        PermissionService $permissionService
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityMerger = $entityMerger;
        $this->permissionService = $permissionService;
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_referencial_Pagination",
     *     options={ "method_prefix" = false }
     * )
     *
     * @Rest\QueryParam(
     *     name="intituleFr",
     *     nullable=true,
     *     description="IntituleFr to search for."
     * )
     * @Rest\QueryParam(
     *     name="intituleAr",
     *     nullable=true,
     *     description="IntituleAr to search for."
     * )
     * @Rest\QueryParam(
     *     name="categorie",
     *     nullable=true,
     *     description="Categorie to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="desc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="10",
     *     description="Max number of referentiels per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The current page"
     * )
     *
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets all  Referenciels with pagination",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class, groups={"ReferencielGroup"}))),
     * @SWG\Response(response="404", description="Returned when mission not found"),
     * )
     */

    public function getReferentielAction(ParamFetcherInterface $paramFetcher)
    {
        $pager = $this->getDoctrine()->getRepository(Referenciel::class)->search(
            $paramFetcher->get('intituleFr'),
            $paramFetcher->get('intituleAr'),
            $paramFetcher->get('categorie'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('page')
        );

        return new Referentiels($pager);
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup"})
     * @Rest\Get(
     *     path = "/all",
     *     name = "app_referencial_list"
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets all  Referenciel",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */
    public function getAllAction(){
        //Get all the referenciels
        $result = ReferencielService::getInstance()->getAllReferenciel($this->em());
        $refs = $this->get('jms_serializer')->serialize($result, 'json', SerializationContext::create()->setGroups(array('ReferencielGroup')));
        $refs = json_decode($refs, JSON_UNESCAPED_UNICODE);
        $response = new Response();
//        dump($result);
//        dump(utf8_encode($response));die;
        $response->setContent(json_encode(["code"=>"200","message"=>"ok",
            "data"=>$refs]));

        $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        //return 200 success response with the referenciels
        //return $this->createApiResponse($result, 200);
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup","filtrecateggroup"})
     * @Rest\Get(
     *     path = "filtre/{categorie}",
     *     name = "app_referencial_categorie-list"
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets   Referenciel filtred by categorie",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */

    public function filtrebycategorieAction($categorie){
        //Get all the referenciels
        $response = ReferencielService::getInstance()->getReferencielbycategorie($this->em(),$categorie);
        //return 200 success response with the referenciels
        return $this->createApiResponse($response, 200);
    }




    /**
     * @Rest\Post(
     *     path = "/new",
     *     name = "app_referencial_add"
     * )
     * @SWG\Post(
     *  tags={"Referenciel"},
     *  summary="Add newReferenciel",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @Rest\RequestParam(name="intitulear")
     * @Rest\RequestParam(name="intitulefr")
     * @Rest\RequestParam(name="intitulean")
     * @Rest\RequestParam(name="categorie")
     * @Rest\RequestParam(name="parent", nullable=true)
     * @Rest\RequestParam(name="longitude",nullable=true)
     * @Rest\RequestParam(name="latitude",nullable=true)
     * @Rest\RequestParam(name="code",nullable=true)
     */
    public function postAddAction(ParamFetcher $paramFetcher)
    {
        //check if the referenciel categorie is valid
        if (!Referenciel::checkIfValidCategorie($paramFetcher->get('categorie')))
            return $this->createApiResponse("Categorie not found", 404);

        //instanciate the referenciel class
        $class = 'Prototype\ReferencielBundle\Entity\\'.$paramFetcher->get('categorie');
        $referenciel = new $class();

        //Set the parameters to the referenciel attributes
        $referenciel->setIntituleFr($paramFetcher->get('intitulefr'));
        $referenciel->setIntituleAr($paramFetcher->get('intitulear'));
        $referenciel->setIntituleAn($paramFetcher->get('intitulean'));
        //Check if the parent referenctiel is specified and affect it
        if($paramFetcher->get('parent')){
            $parentReferenciel = $this->em()->getRepository('PrototypeReferencielBundle:Referenciel')->find($paramFetcher->get('parent'));
            if($parentReferenciel === null)
                return $this->createApiResponse("Parent referenciel not found", 404);
            $referenciel->setParent($parentReferenciel);
        }
        //Persist the referenciel in the database
        $this->em()->persist($referenciel);
        $this->em()->flush();

        //return 200 success response with all the referenciel
        //$this->getAllAction();
        return $this->createApiResponse($referenciel, 201,"crée avec succée");
    }

    /**
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_referencial_Edit",
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Referenciel"},
     *  summary="edit  Referenciel by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @Rest\RequestParam(name="intitulefr")
     * @Rest\RequestParam(name="intitulear")
     *  @Rest\RequestParam(name="intitulean")
     * @Rest\RequestParam(name="categorie")
     * @Rest\RequestParam(name="parent", nullable=true)
     * @Rest\RequestParam(name="image",nullable=true)
     * @Rest\RequestParam(name="type",nullable=true)
     * @Rest\RequestParam(name="heuredebut",nullable=true)
     * @Rest\RequestParam(name="heurefin",nullable=true)
     * @Rest\RequestParam(name="typeprevision",nullable=true)
     * @Rest\RequestParam(name="typecheance",nullable=true)
     * @Rest\RequestParam(name="longitude",nullable=true)
     * @Rest\RequestParam(name="latitude",nullable=true)
     * @Rest\RequestParam(name="hauteur",nullable=true)
     * @Rest\RequestParam(name="code",nullable=true)
     * @Rest\RequestParam(name="imageJourWeb",nullable=true)
     * @Rest\RequestParam(name="imageNuitWeb",nullable=true)
     * @Rest\RequestParam(name="imageJourMobile",nullable=true)
     * @Rest\RequestParam(name="imageNuitMobile",nullable=true)
     * @Rest\RequestParam(name="typezone",nullable=true)
     * @Rest\RequestParam(name="zone",nullable=true)
     * @Rest\RequestParam(name="codecouleur",nullable=true)
     * @Rest\RequestParam(name="title",nullable=true)
     * @Rest\RequestParam(name="descriptionan",nullable=true)
     * @Rest\RequestParam(name="descriptionfr",nullable=true)
     * @Rest\RequestParam(name="descriptionar",nullable=true)
     * @Rest\RequestParam(name="codeftp",nullable=true)

     */
    public function putAction(ParamFetcher $paramFetcher, $id){
        $referenciel =$this->em()->getRepository('PrototypeReferencielBundle:Referenciel')->find($id);
        //Check if the referenciel exist. Return 404 if not.
        if($referenciel === null)
            return $this->createApiResponse("Referenciel not found", 404);
        //Check if the referenciel categorie is valid
        if (!Referenciel::checkIfValidCategorie($paramFetcher->get('categorie')))
            return $this->createApiResponse("Categorie not found", 404);
        //Set the parameters to the referenciel attributes
        $referenciel->setIntituleFr($paramFetcher->get('intitulefr'));
        $referenciel->setIntituleAr($paramFetcher->get('intitulear'));
        $referenciel->setIntituleAn($paramFetcher->get('intitulean'));
        //Check if the parent referenctiel is specified and affect it
        if($paramFetcher->get('parent')){
            $parentReferenciel = $this->em()->getRepository('PrototypeReferencielBundle:Referenciel')->find($paramFetcher->get('parent'));
            if($parentReferenciel === null)
                return $this->createApiResponse("Parent referenciel not found", 404);
            $referenciel->setParent($parentReferenciel);
        }
        if($paramFetcher->get('image')){
            if($referenciel->getImage()!=null){
                $filename=  substr($referenciel->getImage(), (strrpos($referenciel->getImage(),               '/') + 1));
                $targetpath  = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/'.$filename;
                unlink($targetpath);
            }
            $referenciel->setImage($this->base64_to_svg($paramFetcher->get('image')));
        }

        if($paramFetcher->get('imageJourWeb')){
            if($referenciel->getImageJourWeb()!=null){
             $filename=  substr($referenciel->getImageJourWeb(), (strrpos($referenciel->getImageJourWeb(),               '/') + 1));
              $targetpath  = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/'.$filename;
              unlink($targetpath);
            }
            $referenciel->setImageJourWeb($this->base64_to_svg($paramFetcher->get('imageJourWeb')));
        }
        if($paramFetcher->get('imageNuitWeb')){
            if($referenciel->getImageNuitWeb()!=null){
                $filename=  substr($referenciel->getImageNuitWeb(), (strrpos($referenciel->getImageNuitWeb(),               '/') + 1));
                $targetpath  = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/'.$filename;
                unlink($targetpath);
            }
            $referenciel->setImageNuitWeb($this->base64_to_svg($paramFetcher->get('imageNuitWeb')));
        }
        if($paramFetcher->get('imageJourMobile')){
            if($referenciel->getImageJourMobile()!=null){
                $filename=  substr($referenciel->getImageJourMobile(), (strrpos($referenciel->getImageJourMobile(),'/') + 1));
                $targetpath  = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/'.$filename;
                unlink($targetpath);
            }
            $referenciel->setImageJourMobile($this->base64_to_svg($paramFetcher->get('imageJourMobile')));
        }
        if($paramFetcher->get('imageNuitMobile')){
            if($referenciel->getImageNuitMobile()!=null){
                $filename=  substr($referenciel->getImageNuitMobile(), (strrpos($referenciel->getImageNuitMobile(),'/') + 1));
                $targetpath  = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/'.$filename;
                unlink($targetpath);
            }
            $referenciel->setImageNuitMobile($this->base64_to_svg($paramFetcher->get('imageNuitMobile')));
        }
        if($paramFetcher->get('type')){
            $referenciel->setType($paramFetcher->get('type'));
        }
        if($paramFetcher->get('codecouleur')){
            $referenciel->setCodeCouleur($paramFetcher->get('codecouleur'));
        }
        if($paramFetcher->get('typecheance')){
            $referenciel->setTypecheance($paramFetcher->get('typecheance'));
        }
        if($paramFetcher->get('latitude')){
            $referenciel->setLatitude($paramFetcher->get('latitude'));
        }
        if($paramFetcher->get('longitude')){
            $referenciel->setLongitude($paramFetcher->get('longitude'));
        }
        if($paramFetcher->get('hauteur')){
            $referenciel->setHauteur($paramFetcher->get('hauteur'));
        }
        if($paramFetcher->get('code')){
            $referenciel->setCode($paramFetcher->get('code'));
        }
        if($paramFetcher->get('heuredebut')){
            $referenciel->setheuredebut($paramFetcher->get('heuredebut'));
        }
        if($paramFetcher->get('heurefin')){
            $referenciel->setheurefin($paramFetcher->get('heurefin'));
        }

        if($paramFetcher->get('typeprevision')){
            $referenciel->setTypeprevision($paramFetcher->get('typeprevision'));
        }
        if($paramFetcher->get('typezone')){
            $referenciel->setTypeZone($paramFetcher->get('typezone'));
        }
        if($paramFetcher->get('zone')){
            $referenciel->setZone($paramFetcher->get('zone'));
        }
        if($paramFetcher->get('codecouleur')){
            $referenciel->setCodeCouleur($paramFetcher->get('codecouleur'));
        }
        if($paramFetcher->get('title')){
            $referenciel->setTitle($paramFetcher->get('title'));
        }
        if($paramFetcher->get('descriptionan')){
            $referenciel->setDescriptionAn($paramFetcher->get('descriptionan'));
        }
        if($paramFetcher->get('descriptionar')){
            $referenciel->setDescriptionAr($paramFetcher->get('descriptionar'));
        }
        if($paramFetcher->get('descriptionfr')){
            $referenciel->setDescriptionFr($paramFetcher->get('descriptionfr'));
        }
        if($paramFetcher->get('codeftp')){
            $referenciel->setCodeftp($paramFetcher->get('codeftp'));
        }

        //Persist the role in the database
        $this->em()->persist($referenciel);
        $this->em()->flush();
        //return 200 success response with the modified role
        return $this->createApiResponse($referenciel, 202);
    }

    /**
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_referencial_Delete",
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Referenciel"},
     *  summary="delete Referenciel by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     */
    public function deleteAction(?Referenciel $referenciel)
    {
        $this->throwProblem($referenciel, 404, ApiProblem::REFERNCIEL_NOT_EXIST);
        // Remove entity
        return $this->tryDelete($referenciel);
    }

    /**
     * @Rest\View()
     * @Rest\Get(
     *     path = "delegations",
     *     name = "app_delegation-list"
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets   delégations avec les  gouvernorats",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */

    public function getdelegationAction(){
        $delegations = $this->getDoctrine()->getRepository('PrototypeReferencielBundle:Refdelegation')   ->findAll();
        return $this->createApiResponse($delegations, 200);
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"ReferencielGroup","SoleilGroup","LuneGroup","PriereGroup","LuneGroup"})
     * @Rest\Get(
     *     path = "/{champs}/{value}",
     *     name = "app_Referenciel_Search_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Selectionnez la valeur du champs à partir d'une valeur",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource deleted",
     *      @SWG\Schema(type="array", @Model(type=Referenciel::class))),
     *      @SWG\Response(response="400", description="Returned when invalid data posted"),
     *      @SWG\Response(response="401", description="Returned when not authenticated"),
     *      @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @param $request
     * @return JsonResponse
     */
    public function getReferencielfilterAction($champs,$value)
    {
        $referenciel = $this->getDoctrine()
            ->getRepository('PrototypeReferencielBundle:Referenciel')->findBy(array($champs => $value));
        return $referenciel;
    }

    function base64_to_svg($base64_string) {
        $path = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/';
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                die('Echec lors de la création des répertoires...');
            }
        }
        $output_file =$path. md5 ( uniqid () ) . '.' ."svg";
        $ifp = fopen( $output_file, 'wb' );
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp );
        $filename = substr(strrchr($output_file, "/"), 1);
        return "web/uploadspicto/pictogrammes/".$filename;
    }
}
