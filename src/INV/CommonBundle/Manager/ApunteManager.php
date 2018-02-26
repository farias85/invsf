<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 24/02/2018
 * Time: 22:13
 */

namespace INV\CommonBundle\Manager;


use INV\CommonBundle\Entity\Apunte;
use INV\CommonBundle\Util\Entity;

class ApunteManager extends Manager {

    public function create($rotulo, $asunto = 'Control', $descripcion = 'Control') {
        $apunte = new Apunte();

        $apunte->setUsuario($this->getUser());
        $apunte->setRotulo($rotulo);
        $apunte->setAsunto($asunto);
        $apunte->setObservacion($descripcion);
        $apunte->setFecha(new \DateTime('now'));

        $em = $this->getEntityManager();
        $em->persist($apunte);
        $em->flush();

        return $apunte;
    }

    /**
     * @param $apunte Apunte
     */
    public function remove($apunte) {
        $this->getConnection()->transactional(function ($conn) use ($apunte) {
            $em = $this->getEntityManager();
            $chequeos = $em->getRepository(Entity::CHEQUEO)->findBy(['apunte' => $apunte]);
            foreach ($chequeos as $chequeo) {
                $em->remove($chequeo);
            }
            $em->remove($apunte);
            $em->flush();
        });
    }
}