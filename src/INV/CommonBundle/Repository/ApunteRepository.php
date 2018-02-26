<?php

/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 24/02/2018
 * Time: 8:42
 */

namespace INV\CommonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use INV\CommonBundle\Util\Entity;

class ApunteRepository extends EntityRepository {

    public function findCountByRotulo($rotulo) {
        $dql = "";
        $dql .= 'SELECT COUNT(ap.id) 
        FROM ' . Entity::APUNTE . ' ap
        WHERE ap.rotulo = :rotulo';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        $query->setParameter('rotulo', $rotulo);
        return $query->getSingleScalarResult();
    }
}