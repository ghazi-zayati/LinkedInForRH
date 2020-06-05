<?php


namespace Prototype\ReferencielBundle\Services;


use Doctrine\ORM\EntityManager;
use Prototype\ReferencielBundle\Entity\Referenciel;
use Prototype\ConfigBundle\Exception\ApiProblem;
use Prototype\ConfigBundle\Exception\ApiProblemException;


class ReferencielService
{
    private static $referenceService;

    /**
     * @return ReferencielService
     */
    public static function getInstance()
    {
        if (!ReferencielService::$referenceService)
            ReferencielService::$referenceService = new ReferencielService();
        return ReferencielService::$referenceService;
    }

    public function getAllReferenciel(EntityManager $em)
    {

        $referenciels = $em->getRepository('PrototypeReferencielBundle:Referenciel')->findAll();
        $categories = Referenciel::getReferencielCategories();
        $response = array();
        $response['categories'] = $categories;
        $response['referenciels'] = array();
//        foreach($categories as $categorie){
//            $array = [];
//            $className = "Prototype\ReferencielBundle\Entity"."\\".$categorie;
//            $metadata = $em->getClassMetadata($className);
//            $nameMetadata = $metadata->fieldMappings;
//            foreach($nameMetadata as $key =>$value){
//                if($key!="createdAt" and $key!="createdBy" and $key!="updatedAt" and $key!="updatedBy" and $key!="deletedAt" and $key!="deletedBy")
//                $array[$key] = $key;
//            }
//            $response['fields'][$categorie] = $array;
//        }
        foreach ($referenciels as $referenciel) {

            $referenciel->categorie = basename(get_class($referenciel));
            if (!array_key_exists($referenciel->categorie, $response['referenciels']))
                $response['referenciels'][$referenciel->categorie] = array();
            //  $index = $referenciel->categorie;
            array_push($response['referenciels'][$referenciel->categorie], $referenciel);
        }
        return $response;
    }

    public function getReferencielbycategorie(EntityManager $em, $categorie)
    {
        $categories = Referenciel::getReferencielCategories();

        if (!in_array($categorie, $categories->toArray())) {
            $apiProblem = new ApiProblem(
                404,
                ApiProblem::CATEGORIE_NOT_EXIST
            );
            throw new ApiProblemException($apiProblem);
        }
        $entityname = "PrototypeReferencielBundle:" . $categorie;
        $referenciels = $em->getRepository($entityname)->findAll();

        return $referenciels;
    }


    public function getRefastronomiegouvernorat(EntityManager $em, $lang)
    {


        $categories = Referenciel::getReferencielCategories($lang);

        $referenciels = $em->getRepository('PrototypeReferencielBundle:Referenciel')->OrderRefastronomiegouvernorat($lang);

        return $referenciels;

    }


}