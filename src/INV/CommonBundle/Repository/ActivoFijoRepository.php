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

    public function findForAuditoria($idActivo) {
        $dql = "";
        $dql .= 'SELECT act, est, rev, res, loc, tipo  FROM ' . Entity::ACTIVO_FIJO . ' act
        JOIN act.estado est
        JOIN act.revision rev
        JOIN act.responsable res
        JOIN act.local loc
        JOIN act.tipoActivo tipo
        WHERE act.id = :idActivo
        ORDER BY act.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        $query->setParameter('idActivo', $idActivo);
        return $query->getArrayResult()[0];
    }

    public function findByRevisionActivaOK($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1 AND a.estado = 2 
        AND (a.tipoActivo = 2 OR a.tipoActivo = 3 OR a.tipoActivo = 6 OR a.tipoActivo = 7 OR a.tipoActivo = 8 OR a.tipoActivo = 9
         OR a.tipoActivo = 10 OR a.tipoActivo = 11 OR a.tipoActivo = 12 OR a.tipoActivo = 15 OR a.tipoActivo = 16 OR a.tipoActivo = 17) 
        ORDER BY a.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }
}