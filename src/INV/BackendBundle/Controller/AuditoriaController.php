<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 20/02/2018
 * Time: 15:50
 */

namespace INV\BackendBundle\Controller;

use INV\CommonBundle\Controller\NomenclatureController;
use INV\CommonBundle\Form\AuditoriaType;
use INV\CommonBundle\Form\MetadataType;
use INV\CommonBundle\Util\Entity;

class AuditoriaController extends NomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Auditoria';
    }

    public function getEntityName() {
        return Entity::AUDITORIA;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'auditoria';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Auditoria';
    }

    public function defaultKeysFilter() {
        return ['fecha' => 'date', 'rotulo' => 'text', 'aftAntes' => 'text', 'aftDespues' => 'text'];
    }
}