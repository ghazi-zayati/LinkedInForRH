<?php

namespace Prototype\ReferencielBundle\Repository;

use Prototype\ConfigBundle\Repository\AbstractRepository;
use Prototype\ReferencielBundle\Entity\Refzonemarine;
use Prototype\ReferencielBundle\Entity\Refgouvernorat;


/**
 * ReferencielRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReferencielRepository extends AbstractRepository
{
    public function getbydate($date)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:Refecheance', 'ech')
            ->Where('referenciel.id = ech.id')
            ->leftJoin('ech.previsions', 'p')
            ->getQuery()
            ->getResult();
        return $qb;
    }
    public function findregion($region)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:Region', 'reg')
            ->Where('referenciel.id = reg.id')
            ->where('UPPER(referenciel.nom) = UPPER(:region)')
            ->setParameter("region", UPPER($region))
            ->getQuery()
            ->getResult();
        return $qb;
    }
    public function search($intituleFr, $intituleAr, $categorie, $order = 'desc', $limit = 10, $page = 0)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->orderBy('referenciel.id', $order);
        if ($intituleFr) {
            $qb
                ->where('referenciel.intituleFr LIKE :intituleFr')
                ->setParameter('intituleFr', "%{$intituleFr}%");
        }
        if ($intituleAr) {
            $qb
                ->orWhere('referenciel.intituleAr LIKE :intituleAr')
                ->setParameter('intituleAr', "%{$intituleAr}%");
        }
        if ($categorie) {
            $qb->join('PrototypeReferencielBundle:' . $categorie, 'c')
                ->andWhere('referenciel.id = c.id');
        }
        return $this->paginate($qb, $limit, $page);
    }
    public function finddelgationbyname($name)
  {
      $qb = $this
          ->createQueryBuilder('referenciel')
          ->select('referenciel')
          ->leftJoin('PrototypeReferencielBundle:Refdelegation', 'del')
          ->Where('referenciel.id = del.id')
          ->andwhere('upper(referenciel.intituleFr) = upper(:name)')
          ->setParameter("name", $name)
          ->getQuery()
          ->getOneOrNullResult();
      return $qb;
    }
    public function findpaysmondebyname($name)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:Refpaysmonde', 'pay')
            ->Where('referenciel.id = pay.id')
            ->andwhere('upper(referenciel.intituleFr) = upper(:name)')
            ->setParameter("name", $name)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }
    public function getmorevisitedel()
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:Refdelegation', 'del')
            ->Where('referenciel.id = del.id')
            ->orderBy("del.nbvisite","DESC");

          return $qb->getQuery()->getResult();
    }

    public function findstationbyname($name)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:RefRccstation', 'station')
            ->Where('referenciel.id = station.id')
            ->andwhere('upper(referenciel.intituleFr) = upper(:name)')
            ->setParameter("name", $name)
            ->getQuery()
            ->getResult();
        return $qb;
    }


    public function finddelgationbycode($code)
    {
        $qb = $this
            ->createQueryBuilder('referenciel')
            ->select('referenciel')
            ->leftJoin('PrototypeReferencielBundle:Refdelegation', 'del')
            ->Where('referenciel.id = del.id')
            ->andwhere('del.code = :code')
            ->setParameter("code", $code)
            ->getQuery()
            ->getOneOrNullResult();
        return $qb;
    }



}
