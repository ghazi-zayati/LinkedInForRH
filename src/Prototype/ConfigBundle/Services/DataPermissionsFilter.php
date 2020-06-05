<?php

namespace Prototype\ConfigBundle\Services;

use Doctrine\ORM\Mapping\ClassMetaData;
use Doctrine\ORM\Query\Filter\SQLFilter;

use Prototype\ConfigBundle\EventListener\AuthenticationSuccessListener as Token;

class DataPermissionsFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        //Test if user is logged in


        return '';
    }
}
