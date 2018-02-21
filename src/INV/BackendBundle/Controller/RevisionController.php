<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 20/02/2018
 * Time: 15:50
 */

namespace INV\BackendBundle\Controller;

use INV\CommonBundle\Controller\NomenclatureController;
use INV\CommonBundle\Form\RevisionType;
use INV\CommonBundle\Util\Entity;

class RevisionController extends NomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Revisión';
    }

    public function getEntityName() {
        return Entity::REVISION;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'revision';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Revision';
    }

    public function getFormTypeClass() {
        return RevisionType::class;
    }

    public function defaultKeysFilter() {
        return ['id' => 'text', 'activo' => 'bool', 'fechaEnSistema' => 'date',
            'fechaExcel' => 'date', 'excelUrl' => 'text'];
    }
}