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

class ActivoFijoRepository extends EntityRepository {

    public function findByRevisionActiva($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1  
        ORDER BY a.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }
}