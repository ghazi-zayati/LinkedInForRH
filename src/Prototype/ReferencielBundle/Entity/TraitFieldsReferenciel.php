<?php

namespace Prototype\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TraitFieldsReferenciel
 */

/**
 * @ORM\Discriminator(field = "code")
 * @Serializer\ExclusionPolicy("ALL")
 */
trait TraitFieldsReferenciel
{


    /**
     * @ORM\Column(name="code", type="text",nullable=true)
     * @Serializer\Groups({"detailDemande","listDemande"})
     * @Serializer\Expose()
     */
    private $code;

    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return code
     */

    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

}