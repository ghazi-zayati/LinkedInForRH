<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Abidi
 * Date: 06/11/2018
 * Time: 14:04
 */

namespace Prototype\ReferencielBundle\Representation;

use JMS\Serializer\Annotation as Serializer;
use Pagerfanta\Pagerfanta;

/**
 * Class Referentiels
 * @package Prototype\ReferentielBundle\Representation
 * @Serializer\ExclusionPolicy("all")
 */
class Referentiels
{
    /**
     * @Serializer\Type("array<Prototype\ReferencielBundle\Entity\Referenciel>")
     * @Serializer\Groups("ReferencielGroup")
     * @Serializer\Expose()
     */
    public $data;

    /**
     * @Serializer\Groups("ReferencielGroup")
     * @Serializer\Expose()
     */
    public $meta;

    public function __construct(Pagerfanta $data)
    {
        $this->data = $data->getCurrentPageResults();

        $this->addMeta('limit', $data->getMaxPerPage());
        //$this->addMeta('current_items', count($data->getCurrentPageResults()));
        $this->addMeta('total', $data->getNbResults());
        $this->addMeta('page', $data->getCurrentPage());
        $this->addMeta('pages', $data->getNbPages());
    }

    public function addMeta($name, $value)
    {
        if (isset($this->meta[$name])) {
            throw new \LogicException(sprintf('This meta already exists. You are trying to override this meta, use the setMeta method instead for the %s meta.', $name));
        }

        $this->setMeta($name, $value);
    }

    public function setMeta($name, $value)
    {
        $this->meta[$name] = $value;
    }
}