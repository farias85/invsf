<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 20/02/2018
 * Time: 15:50
 */

namespace INV\BackendBundle\Controller;

use INV\CommonBundle\Controller\UniqueNomenclatureController;
use INV\CommonBundle\Util\Entity;

class EstadoController extends UniqueNomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Estado';
    }

    public function getEntityName() {
        return Entity::ESTADO;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'estado';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Estado';
    }

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public function keysUnique() {
        return ['nombre'];
    }
}