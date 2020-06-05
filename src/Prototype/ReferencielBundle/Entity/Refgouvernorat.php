<?php

namespace Prototype\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Prototype\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * Refgouvernorat
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class Refgouvernorat extends Referenciel
{
    use TraitFieldsReferenciel;

    /**
     * @ORM\Column(name="longitude", type="text",nullable=true)
     * @Serializer\Groups({"observGrp","observetrang","PrevisionLocaleGroup","vigilanceGrp"})
     * @Serializer\Expose()
     */
    protected $longitude;
    /**
     * @ORM\Column(name="latitude", type="text",nullable=true)
     *  @Serializer\Groups({"observGrp","observetrang","PrevisionLocaleGroup","vigilanceGrp"})
     * @Serializer\Expose()
     */
    protected $latitude;


    /**
     * Set intituleAn.
     *
     * @param string $intituleAn
     *
     * @return Refgouvernorat
     */
    public function setIntituleAn($intituleAn)
    {
        $this->intituleAn = $intituleAn;

        return $this;
    }

    /**
     * Get intituleAn.
     *
     * @return string
     */
    public function getIntituleAn()
    {
        return $this->intituleAn;
    }

    /**
     * Set longitude.
     *
     * @param string|null $longitude
     *
     * @return Refgouvernorat
     */
    public function setLongitude($longitude = null)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude.
     *
     * @param string|null $latitude
     *
     * @return Refgouvernorat
     */
    public function setLatitude($latitude = null)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

}
