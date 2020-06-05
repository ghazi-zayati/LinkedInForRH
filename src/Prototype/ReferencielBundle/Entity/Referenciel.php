<?php

namespace Prototype\ReferencielBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Prototype\ConfigBundle\Entity\AbstractEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Referenciel
 *
 * @ORM\Table(name="referenciel")
 * @ORM\Entity(repositoryClass="Prototype\ReferencielBundle\Repository\ReferencielRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="categorie", type="string")
 * @ORM\DiscriminatorMap({
 *     "Referenciel" = "Referenciel",
 *     "Refgouvernorat" = "Refgouvernorat",
 *     "Refdelegation" = "Refdelegation",
 * })
 * @Serializer\ExclusionPolicy("ALL")
 */

class Referenciel {

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup"})
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_fr", type="string", length=255)
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $intituleFr;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_ar", type="string", length=255)
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $intituleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_an", type="string", length=255)
     * @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $intituleAn;

    /**
     * @ORM\OneToMany(targetEntity="Referenciel", mappedBy="parent")
     * @ORM\OrderBy({"intituleFr" = "ASC"})
     *  @Serializer\Groups({"filtrecateggroup"})
     * @Serializer\Expose()
     * @Groups({"filtrecateggroup"}),
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Referenciel", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     * @Serializer\Groups({"ReferencielGroup", "AppUserGroup"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $parent;

    /**
     * Default constructor, initializes collections
     */
    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set intituleFr.
     *
     * @param string $intituleFr
     *
     * @return Referenciel
     */
    public function setIntituleFr($intituleFr) {
        $this->intituleFr = $intituleFr;

        return $this;
    }

    /**
     * Get intituleFr.
     *
     * @return string
     */
    public function getIntituleFr() {
        return $this->intituleFr;
    }

    /**
     * Set intituleAr.
     *
     * @param string $intituleAr
     *
     * @return Referenciel
     */
    public function setIntituleAr($intituleAr) {
        $this->intituleAr = $intituleAr;

        return $this;
    }

    /**
     * Get intituleAr.
     *
     * @return string
     */
    public function getIntituleAr() {
        return $this->intituleAr;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    /**
     * @return Referenciel
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param Referenciel $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }

    /**
     * Method to retrieve the possible categories for a reference
     * @return ArrayCollection
     */
    public static function getReferencielCategories() {
        $categorie = new ArrayCollection();
        $categorie->add("Refgouvernorat");
        $categorie->add("Refdelegation");
   //    $categorie->add("RefNatureBesoinSpecifique");
    //    $categorie->add("RefNiveauEtude");
       // $categorie->add("RefNationalite");
    //    $categorie->add("RefDomaine");
    //    $categorie->add("RefSecteur");
     //   $categorie->add("RefJustificatifExperience");
     //   $categorie->add("RefDirectionRegionale");
    //    $categorie->add("RefCentreFormation");
   //     $categorie->add("RefSpecialiteCentreFormation");
     //   $categorie->add("RefDelais");
//        $categorie->add("Refdirectionvent");
//        $categorie->add("Refpictogramme");
//        $categorie->add("Refcategoriepictogramme");
//        $categorie->add("Refvilleetrangere");
//        $categorie->add("Refecheance");
//        $categorie->add("Refnbjours");
//        $categorie->add("RefPlage");
//        $categorie->add("Refpaysmonde");
//        //$categorie->add("Refvigillancepictogramme");
//        $categorie->add("Refvigillancezone");
//        $categorie->add("Refvigillancecouleur");
//        $categorie->add("Refzonemarine");
//        $categorie->add("Refzoneclimatologie");
//        $categorie->add("Refprevisisonmarine_force");
//        $categorie->add("Refprevisisonmarine_mer_etat");
//        $categorie->add("Refprevisisonmarine_direction");
//        $categorie->add("Refprevisisonmarine_visibilite");
//        $categorie->add("Refprevisionmarine_transition");
//        $categorie->add("RefVigilancePictogramme");
//        $categorie->add("Refastronomiedelegation");
//        $categorie->add("Refastronomiegouvernorat");
//        $categorie->add("Refzoneplage");
//        $categorie->add("Refforcesismique");
//        $categorie->add("RefAvisa");
//        $categorie->add("RefAvisstatus1");
//        $categorie->add("RefAvisstatus2");
//        $categorie->add("RefHeurevalidite");
//        $categorie->add("RefStatusmenace");
//        $categorie->add("RefguidePrevention");
//        $categorie->add("RefdegatsPossibles");
//        $categorie->add("RefBmstransition");
//        $categorie->add("RefRccstation");
//        $categorie->add("RefRccvariable");
//        $categorie->add("RefRccpay");
        return $categorie;
    }

    /**
     * Method to check if the categorie is valid
     * @return bool
     */
    public static function checkIfValidCategorie($categorie) {
        $categories = Referenciel::getReferencielCategories();
        return $categories->contains($categorie);
    }

    /**
     * Add child.
     *
     * @param \Prototype\ReferencielBundle\Entity\Referenciel $child
     *
     * @return Referenciel
     */
    public function addChild(\Prototype\ReferencielBundle\Entity\Referenciel $child) {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \Prototype\ReferencielBundle\Entity\Referenciel $child
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChild(\Prototype\ReferencielBundle\Entity\Referenciel $child) {
        return $this->children->removeElement($child);
    }

    /**
     * Set intituleAn.
     *
     * @param string $intituleAn
     *
     * @return Referenciel
     */
    public function setIntituleAn($intituleAn) {
        $this->intituleAn = $intituleAn;

        return $this;
    }

    /**
     * Get intituleAn.
     *
     * @return string
     */
    public function getIntituleAn() {
        return $this->intituleAn;
    }

}