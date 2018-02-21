<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 20/02/2018
 * Time: 15:50
 */

namespace INV\BackendBundle\Controller;

use INV\CommonBundle\Controller\UniqueNomenclatureController;
use INV\CommonBundle\Form\ResponsableType;
use INV\CommonBundle\Util\Entity;

class ResponsableController extends UniqueNomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Responsable';
    }

    public function getEntityName() {
        return Entity::RESPONSABLE;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'responsable';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Responsable';
    }

    public function getFormTypeClass() {
        return ResponsableType::class;
    }

    public function defaultKeysFilter() {
        return ['nombre' => 'text', 'descripcion' => 'text', 'email' => 'text'];
    }

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public function keysUnique() {
        return ['nombre', 'email'];
    }
}