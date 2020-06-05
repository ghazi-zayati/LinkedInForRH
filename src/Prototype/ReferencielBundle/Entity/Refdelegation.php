<?php

namespace Prototype\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;
use Prototype\ReferencielBundle\Entity\TraitFieldsReferenciel;


/**
 * Refdelegation
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */

class Refdelegation extends Referenciel
{
    use TraitFieldsReferenciel;
    /**
     * @ORM\Column(name="longitude", type="text",nullable=true)
     *  @Serializer\Groups({"observGrp","observetrang","PrevisionLocaleGroup"})
     * @Serializer\Expose()
     */
    protected $longitude;
    /**
     * @ORM\Column(name="latitude", type="text",nullable=true)
     *  @Serializer\Groups({"observGrp","observetrang","PrevisionLocaleGroup"})
     * @Serializer\Expose()
     */
    protected $latitude;

    /**
     * Set intituleAn.
     *
     * @param string $intituleAn
     *  @Serializer\Groups({"observGrp"})
     * @Serializer\Expose()
     * @return Refdelegation
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
     * Set x.
     *
     * @param string|null $x
     *
     * @return Refdelegation
     */
    public function setX($x = null)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x.
     *
     * @return string|null
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y.
     *
     * @param string|null $y
     *
     * @return Refdelegation
     */
    public function setY($y = null)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y.
     *
     * @return string|null
     */
    public function getY()
    {
        return $this->y;
    }


    /**
     * Set longitude.
     *
     * @param string|null $longitude
     *
     * @return Refdelegation
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
     * @return Refdelegation
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
