<?php
/**
 * Created by PhpStorm.
 * User: Olfa Hadidi
 * Date: 04/02/2019
 * Time: 12:08
 */

namespace Prototype\ConfigBundle\Representation;

use JMS\Serializer\Annotation as Serializer;
use Pagerfanta\Pagerfanta;

/**
 * Class UsersApp
 * @package Prototype\ConfigBundle\Representation
 * @Serializer\ExclusionPolicy("all")
 */
class UsersApp
{
    /**
     * @Serializer\Type("array<Prototype\ConfigBundle\Entity\AppUser>")
     * @Serializer\Groups("AppUserGroup")
     * @Serializer\Expose()
     */
    public $data;

    /**
     * @Serializer\Groups("AppUserGroup")
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