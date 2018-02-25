<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 24/02/2018
 * Time: 21:24
 */

namespace INV\CommonBundle\Manager;


use INV\CommonBundle\Entity\Auditoria;

class AuditoriaManager extends Manager {

    /**
     * @param $antes mixed
     * @param $despues mixed
     * @param $entity string
     * @param $descripcion string
     */
    public function create($antes, $despues, $rotulo, $entity, $descripcion = '') {
        $auditoria = new Auditoria();

        $auditoria->setAntes(json_encode($antes));
        $auditoria->setDespues(json_encode($despues));
        $auditoria->setFecha(new \DateTime('now'));
        $auditoria->setEntity($entity);
        $auditoria->setRotulo($rotulo);
        $auditoria->setUsuario($this->getUser());
        $auditoria->setDescripcion($descripcion);

        $em = $this->getEntityManager();
        $em->persist($auditoria);
        $em->flush();
    }
}