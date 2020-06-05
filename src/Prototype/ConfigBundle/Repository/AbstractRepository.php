<?php
/**
 * Created by PhpStorm.
 * User: Ahmed Abidi
 * Date: 06/11/2018
 * Time: 14:06
 */

namespace Prototype\ConfigBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class AbstractRepository extends EntityRepository
{
    protected function paginate(QueryBuilder $qb, int $limit = 10, int $page = 0) {
        if (!($limit >= 0 && $page >= 0)) {
            throw new \LogicException('$limit & $page must be greater than 0. limit = ' .  $limit . ' offset = ' . $page);
            //Greater est >= 0 et au cas où ce n'est PAS le cas l'erreur est déclenchée.
        }
        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));

        $pager->setMaxPerPage($limit);
        $pager->setCurrentPage($page);
        return $pager;
    }


}