<?php

namespace Prototype\ConfigBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AppUser
 *
 * @ORM\Table(name="app_user")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Prototype\ConfigBundle\Repository\AppUserRepository")
 * @UniqueEntity(fields={"username","email"}, message="Username existe deja")
 * @Serializer\ExclusionPolicy("ALL")
 */
class AppUser implements UserInterface
{

    use AbstractEntity;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeUserGroup","listDemande", "AppUserGroup", "MissionGroup", "ProgrammeGroup", "ProjetGroup", "SousProgrammeGroup", "MissionLoginGroup", "ProgrammeLoginGroup"})
     * @Serializer\Expose()
     * @Groups({"AppUserGroup", "MissionGroup", "ProgrammeGroup", "SousProgrammeGroup", "ProjetGroup"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom_fr", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","listDemande","DeserializeUserGroup","DrupalProgrammeGroup"})
     * @Serializer\Expose()
     */
    private $nomFr;

    /**
     * @var string
     * @ORM\Column(name="nom_ar", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $nomAr;

    /**
     * @var string
     * @ORM\Column(name="prenom_fr", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","listDemande",  "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $prenomFr;

    /**
     * @var string
     * @ORM\Column(name="prenom_ar", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $prenomAr;

    /**
     * @var int
     * @ORM\Column(name="tel", type="string",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $tel;

    /**
     * @var int
     * @ORM\Column(name="num_cin", type="string",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $numCin;

    /**
     * @var int
     * @ORM\Column(name="num_passport",type="string", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande"})
     * @Serializer\Expose()
     */
    private $numPassport;


    /**
     * @ORM\Column(name="num_carte_sejour",type="string", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $numCarteSejour;

//    /**
//     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\RefNationalite")
//     * @ORM\JoinColumn(name="nationalite", referencedColumnName="id")
//     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
//     * @Serializer\Expose()
//     */
//    private $nationalite;


    /**
     * @var \DateTime
     * @ORM\Column(name="date_delivrance_cin", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $dateDelivranceCin;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_delivrance_passport", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $dateDelivrancePassport;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $dateInscription;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_validite_sejour", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $dateValiditeSejour;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_naissance", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $dateNaissance;

    /**
     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\Refgouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\Refdelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $delegation;

//    /**
//     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\RefNatureBesoinSpecifique")
//     * @ORM\JoinColumn(name="nature_besoin_specifique", referencedColumnName="id")
//     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
//     * @Serializer\Expose()
//     */
//    private $natureBesoinSpecifique;

//    /**
//     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\RefNiveauEtude")
//     * @ORM\JoinColumn(name="niveau_etude", referencedColumnName="id")
//     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
//     * @Serializer\Expose()
//     */
//    private $niveauEtude;

    /**
     * @ORM\Column(type="string",unique=true)
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $username;

    /**
     * @ORM\Column(type="string" , nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $sexe;

//    /**
//     * @ORM\ManyToOne(targetEntity="Prototype\ReferencielBundle\Entity\RefCentreFormation")
//     * @ORM\JoinColumn(name="centre_formation", referencedColumnName="id")
//     * @Serializer\Groups({"AppUserGroup","listDemande", "detailDemande", "DeserializeUserGroup"})
//     * @Serializer\Expose()
//     */
//    private $centreFormation;
    /**
     * @ORM\Column(name="lieu_naissance", type="string", length=255, unique=false, nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string",nullable=true, unique=false)
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $identifiant;

    /**
     * @ORM\Column(name="personne_besoin_specifique", type="boolean", options={"default":false},nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $personneBesoinSpecifique;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $email;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $enable;

    /**
     * @var boolean
     * @ORM\Column(name="first_login", type="integer",options={"default":0} )
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $firstLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Serializer\Groups({"DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="passwordPrint", type="string", length=255)
     * @Serializer\Groups({"DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $passwordPrint;

    /**
     * @var string
     */

    private $plainPassword;

    /**
     * @var \Doctrine\Common\Collections\Collection|Role[]
     * @ORM\ManyToMany(targetEntity="Prototype\ConfigBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(
     *  name="user_role",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"DeserializeUserGroup","AppUserGroup"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ userroles est obligatoire")
     */
    private $userRoles;

    /**
     * Default constructor, initializes collections
     */
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->dateInscription = new \DateTime();
        $this->firstLogin = 0;
//        $this->gouvernorat = new ArrayCollection();
//        $this->delegation = new ArrayCollection();
//        $this->natureBesoinSpecifique = new ArrayCollection();
//        $this->niveauEtude = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNomFr()
    {
        return $this->nomFr;
    }

    /**
     * @param string $nomFr
     */
    public function setNomFr($nomFr)
    {
        $this->nomFr = $nomFr;
    }

    /**
     * @return string
     */
    public function getNomAr()
    {
        return $this->nomAr;
    }

    /**
     * @param string $nomAr
     */
    public function setNomAr($nomAr)
    {
        $this->nomAr = $nomAr;
    }

    /**
     * @return string
     */
    public function getPrenomFr()
    {
        return $this->prenomFr;
    }

    /**
     * @param string $prenomFr
     */
    public function setPrenomFr($prenomFr)
    {
        $this->prenomFr = $prenomFr;
    }

    /**
     * @return string
     */
    public function getPrenomAr()
    {
        return $this->prenomAr;
    }

    /**
     * @param string $prenomAr
     */
    public function setPrenomAr($prenomAr)
    {
        $this->prenomAr = $prenomAr;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return AppUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param boolean $enable
     *
     * @return AppUser
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return AppUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Role[]
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Role[] $roles
     */
    public function setUserRoles($roles)
    {
        $this->userRoles = $roles;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if ($this->userRoles->contains($role)) {
            return;
        }
        $this->userRoles->add($role);
        $role->addUser($this);
    }

    /**
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        if (!$this->userRoles->contains($role)) {
            return;
        }
        $this->userRoles->removeElement($role);
        $role->removeUser($this);
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //$this->password='';
    }

    /**
     * Add userRole.
     *
     * @param \Prototype\ConfigBundle\Entity\Role $userRole
     *
     * @return AppUser
     */
    public function addUserRole(\Prototype\ConfigBundle\Entity\Role $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Set numCin.
     *
     * @param int|null $numCin
     *
     * @return AppUser
     */
    public function setNumCin($numCin = null)
    {
        $this->numCin = $numCin;

        return $this;
    }

    /**
     * Get numCin.
     *
     * @return int|null
     */
    public function getNumCin()
    {
        return $this->numCin;
    }


    /**
     * Set dateDelivrance.
     *
     * @param \DateTime|null $dateDelivrancePassport
     *
     * @return AppUser
     */
    public function setDateDelivrancePassport($dateDelivrancePassport = null)
    {
        $this->dateDelivrancePassport = $dateDelivrancePassport;

        return $this;
    }

    /**
     * Get dateDelivrancePassport.
     *
     * @return \DateTime|null
     */
    public function getDateDelivrancePassport()
    {
        return $this->dateDelivrancePassport;
    }

    /**
     * Set dateInscription.
     *
     * @param \DateTime|null $dateInscription
     *
     * @return AppUser
     */
    public function setDateInscription($dateInscription = null)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription.
     *
     * @return \DateTime|null
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set dateValiditeSejour.
     *
     * @param \DateTime|null $dateValiditeSejour
     *
     * @return AppUser
     */
    public function setDateValiditeSejour($dateValiditeSejour = null)
    {
        $this->dateValiditeSejour = $dateValiditeSejour;

        return $this;
    }

    /**
     * Get dateValiditeSejour.
     *
     * @return \DateTime|null
     */
    public function getDateValiditeSejour()
    {
        return $this->dateValiditeSejour;
    }

    /**
     * Set dateNaissance.
     *
     * @param \DateTime|null $dateNaissance
     *
     * @return AppUser
     */
    public function setDateNaissance($dateNaissance = null)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance.
     *
     * @return \DateTime|null
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set sexe.
     *
     * @param string $sexe
     *
     * @return AppUser
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe.
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set personneBesoinSpecifique.
     *
     * @param bool $personneBesoinSpecifique
     *
     * @return AppUser
     */
    public function setPersonneBesoinSpecifique($personneBesoinSpecifique)
    {
        $this->personneBesoinSpecifique = $personneBesoinSpecifique;

        return $this;
    }

    /**
     * Get personneBesoinSpecifique.
     *
     * @return bool
     */
    public function getPersonneBesoinSpecifique()
    {
        return $this->personneBesoinSpecifique;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Prototype\ReferencielBundle\Entity\Refgouvernorat|null $gouvernorat
     *
     * @return AppUser
     */
    public function setGouvernorat(\Prototype\ReferencielBundle\Entity\Refgouvernorat $gouvernorat = null)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat.
     *
     * @return \Prototype\ReferencielBundle\Entity\Refgouvernorat|null
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set delegation.
     *
     * @param \Prototype\ReferencielBundle\Entity\Refdelegation|null $delegation
     *
     * @return AppUser
     */
    public function setDelegation(\Prototype\ReferencielBundle\Entity\Refdelegation $delegation = null)
    {
        $this->delegation = $delegation;

        return $this;
    }

    /**
     * Get delegation.
     *
     * @return \Prototype\ReferencielBundle\Entity\Refdelegation|null
     */
    public function getDelegation()
    {
        return $this->delegation;
    }

//    /**
//     * Set natureBesoinSpecifique.
//     *
//     * @param \Prototype\ReferencielBundle\Entity\RefNatureBesoinSpecifique|null $natureBesoinSpecifique
//     *
//     * @return AppUser
//     */
//    public function setNatureBesoinSpecifique(\Prototype\ReferencielBundle\Entity\RefNatureBesoinSpecifique $natureBesoinSpecifique = null)
//    {
//        $this->natureBesoinSpecifique = $natureBesoinSpecifique;
//
//        return $this;
//    }
//
//    /**
//     * Get natureBesoinSpecifique.
//     *
//     * @return \Prototype\ReferencielBundle\Entity\RefNatureBesoinSpecifique|null
//     */
//    public function getNatureBesoinSpecifique()
//    {
//        return $this->natureBesoinSpecifique;
//    }

//    /**
//     * Set niveauEtude.
//     *
//     * @param \Prototype\ReferencielBundle\Entity\RefNiveauEtude|null $niveauEtude
//     *
//     * @return AppUser
//     */
//    public function setNiveauEtude(\Prototype\ReferencielBundle\Entity\RefNiveauEtude $niveauEtude = null)
//    {
//        $this->niveauEtude = $niveauEtude;
//
//        return $this;
//    }
//
//    /**
//     * Get niveauEtude.
//     *
//     * @return \Prototype\ReferencielBundle\Entity\RefNiveauEtude|null
//     */
//    public function getNiveauEtude()
//    {
//        return $this->niveauEtude;
//    }

    /**
     * Remove userRole.
     *
     * @param \Prototype\ConfigBundle\Entity\Role $userRole
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserRole(\Prototype\ConfigBundle\Entity\Role $userRole)
    {
        return $this->userRoles->removeElement($userRole);
    }


    /**
     * Set identifiant.
     *
     * @param string $identifiant
     *
     * @return AppUser
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get identifiant.
     *
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }


//    /**
//     * Set nationalite.
//     *
//     * @param \Prototype\ReferencielBundle\Entity\RefNationalite|null $nationalite
//     *
//     * @return AppUser
//     */
//    public function setNationalite(\Prototype\ReferencielBundle\Entity\RefNationalite $nationalite = null)
//    {
//        $this->nationalite = $nationalite;
//
//        return $this;
//    }
//
//    /**
//     * Get nationalite.
//     *
//     * @return \Prototype\ReferencielBundle\Entity\RefNationalite|null
//     */
//    public function getNationalite()
//    {
//        return $this->nationalite;
//    }

    /**
     * Set numCarteSejour.
     *
     * @param string $numCarteSejour
     *
     * @return AppUser
     */
    public function setNumCarteSejour($numCarteSejour)
    {
        $this->numCarteSejour = $numCarteSejour;

        return $this;
    }

    /**
     * Get numCarteSejour.
     *
     * @return string
     */
    public function getNumCarteSejour()
    {
        return $this->numCarteSejour;
    }


    /**
     * Set lieuNaissance.
     *
     * @param string|null $lieuNaissance
     *
     * @return AppUser
     */
    public function setLieuNaissance($lieuNaissance = null)
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    /**
     * Get lieuNaissance.
     *
     * @return string|null
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * Set dateDelivranceCin.
     *
     * @param \DateTime|null $dateDelivranceCin
     *
     * @return AppUser
     */
    public function setDateDelivranceCin($dateDelivranceCin = null)
    {
        $this->dateDelivranceCin = $dateDelivranceCin;

        return $this;
    }

    /**
     * Get dateDelivranceCin.
     *
     * @return \DateTime|null
     */
    public function getDateDelivranceCin()
    {
        return $this->dateDelivranceCin;
    }

    /**
     * Set numPassport.
     *
     * @param string|null $numPassport
     *
     * @return AppUser
     */
    public function setNumPassport($numPassport = null)
    {
        $this->numPassport = $numPassport;

        return $this;
    }

    /**
     * Get numPassport.
     *
     * @return string|null
     */
    public function getNumPassport()
    {
        return $this->numPassport;
    }

    /**
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return AppUser
     */
    public function setTel($tel = null)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel.
     *
     * @return string|null
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set firstConnect.
     *
     * @param bool|null $firstConnect
     *
     * @return AppUser
     */
    public function setFirstConnect($firstConnect = null)
    {
        $this->firstConnect = $firstConnect;

        return $this;
    }

    /**
     * Get firstConnect.
     *
     * @return bool|null
     */
    public function getFirstConnect()
    {
        return $this->firstConnect;
    }

    /**
     * Set firstLogin.
     *
     * @param int|null $firstLogin
     *
     * @return AppUser
     */
    public function setFirstLogin($firstLogin = null)
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }

    /**
     * Get firstLogin.
     *
     * @return int|null
     */
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    /**
     * Set passwordPrint.
     *
     * @param string $passwordPrint
     *
     * @return AppUser
     */
    public function setPasswordPrint($passwordPrint)
    {
        $this->passwordPrint = $passwordPrint;

        return $this;
    }

    /**
     * Get passwordPrint.
     *
     * @return string
     */
    public function getPasswordPrint()
    {
        return $this->passwordPrint;
    }

//    /**
//     * Set centreFormation.
//     *
//     * @param \Prototype\ReferencielBundle\Entity\RefCentreFormation|null $centreFormation
//     *
//     * @return AppUser
//     */
//    public function setCentreFormation(\Prototype\ReferencielBundle\Entity\RefCentreFormation $centreFormation = null)
//    {
//        $this->centreFormation = $centreFormation;
//
//        return $this;
//    }
//
//    /**
//     * Get centreFormation.
//     *
//     * @return \Prototype\ReferencielBundle\Entity\RefCentreFormation|null
//     */
//    public function getCentreFormation()
//    {
//        return $this->centreFormation;
//    }
}
