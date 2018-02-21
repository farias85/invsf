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

class RolController extends UniqueNomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Rol';
    }

    public function getEntityName() {
        return Entity::ROL;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'rol';
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Rol';
    }

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public function keysUnique() {
        return ['nombre'];
    }
}