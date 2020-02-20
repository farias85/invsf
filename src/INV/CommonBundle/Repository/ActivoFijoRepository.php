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

    //Estados: 1 roto, 2 ok, 3 Prestamo
    //Equipos: 2 monitor, 3 pc, 6 laptop, 7 backup,  8 telefono, 9 aire  acondicionado, 10 teclado, 11 impresora, 12 otros informáticos, 15 ventilador, 16 tv, 17 equipo

    public function findByRevisionActivaOK($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1 AND (a.estado = 2 OR a.estado = 3)
        AND (a.tipoActivo = 2 OR a.tipoActivo = 3 OR a.tipoActivo = 6 OR a.tipoActivo = 7 OR a.tipoActivo = 8 OR a.tipoActivo = 9
         OR a.tipoActivo = 10 OR a.tipoActivo = 11 OR a.tipoActivo = 12 OR a.tipoActivo = 15 OR a.tipoActivo = 16 OR a.tipoActivo = 17) 
        ORDER BY a.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }

    public function findByRevisionActivaRotos($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1 AND (a.estado = 1 OR a.estado = 4) 
        AND (a.tipoActivo = 2 OR a.tipoActivo = 3 OR a.tipoActivo = 6 OR a.tipoActivo = 7 OR a.tipoActivo = 8 OR a.tipoActivo = 9
         OR a.tipoActivo = 10 OR a.tipoActivo = 11 OR a.tipoActivo = 12 OR a.tipoActivo = 15 OR a.tipoActivo = 16 OR a.tipoActivo = 17) 
        ORDER BY a.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }

    public function findByRevisionTodos($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1 
        ORDER BY a.rotulo ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }

    /**
     * El estado = 4 es, en proceso de baja
     * @param bool $hidrate
     * @return array|mixed
     *
     */
    public function findByBaja($hidrate = false) {
        $dql = "";
        $dql .= 'SELECT a FROM ' . Entity::ACTIVO_FIJO . ' a 
        JOIN a.revision r
        WHERE r.activo = 1 AND a.estado = 4 
        ORDER BY a.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }
}