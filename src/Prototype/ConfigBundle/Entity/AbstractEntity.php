<?php

namespace Prototype\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * AbstractEntity
 */
/**
 * @ORM\HasLifecycleCallbacks
 *@ORM\Discriminator(field = "createdAt", groups={"BmsGroup"})
 * @Serializer\ExclusionPolicy("ALL")
 */
trait AbstractEntity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime",nullable=true)
     * @Serializer\Groups({"BmsGroup", "detailDemande", "listDemande"})
     * @Serializer\Expose()
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer",nullable=true)
     * @Serializer\Groups({"BmsGroup", "detailDemande", "listDemande"})
     * @Serializer\Exclude()
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime",nullable=true)
     * @Serializer\Groups({"BmsGroup", "detailDemande", "listDemande"})
     * @Serializer\Exclude()
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="updated_by", type="integer",nullable=true)
     * @Serializer\Groups({"BmsGroup", "detailDemande", "listDemande"})
     * @Serializer\Exclude()
     */
    private $updatedBy;
	
	/**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup","RoleGroup"})
     * @Serializer\Expose()
     */
    private $deleted = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Serializer\Exclude()
     */
    private $deletedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="deleted_by", type="integer", nullable=true)
     * @Serializer\Exclude()
     */
    private $deletedBy;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param int $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }
    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }
    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return int
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * @param int $deletedBy
     */
    public function setDeletedBy($deletedBy)
    {
        $this->deletedBy = $deletedBy;
    }
    
     /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist() {
        $this->createdAt = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate() {
        $this->updatedAt = new \DateTime("now");
    }   

}