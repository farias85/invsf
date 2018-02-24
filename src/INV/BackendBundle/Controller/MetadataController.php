<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 20/02/2018
 * Time: 15:50
 */

namespace INV\BackendBundle\Controller;

use INV\CommonBundle\Controller\NomenclatureController;
use INV\CommonBundle\Util\Entity;

class MetadataController extends NomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Metadata';
    }

    public function getEntityName() {
        return Entity::METADATA;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'metadata';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Metadata';
    }

    public function defaultKeysFilter() {
        return ['totalActivos' => 'text', 'valorTotal' => 'text', 'valorTotalMc' => 'text',
            'depAcuTotal' => 'text', 'depAcuTotalMc' => 'text', 'revision' => 'text'];
    }
}