<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 13/02/2018
 * Time: 15:51
 */

namespace INV\CommonBundle\Controller;


abstract class UniqueNomenclatureController extends NomenclatureController {

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public abstract function keysUnique();

    public function newActionIsFormValid($fullEntityNamem, $data) {
        $uniques = $this->keysUnique();
        $em = $this->getDoctrine()->getManager();

        foreach ($uniques as $attr) {
            $exist = $em->getRepository($this->getEntityName())->findOneBy([$attr => $data[$attr]]);
            if (!empty($exist)) {
                $words = preg_split("/[:]/", $this->getEntityName());
                $simpleEntityName = $words[1];
                $message = $this->get('translator')->trans('operation.new.fail', [
                    '%clazz%' => $simpleEntityName,
                    '%attr%' => $attr,
                    '%value%' => $data[$attr],
                ], 'common');
                return ['valid' => false, 'error' => $message];
            }
        }
        return ['valid' => true];
    }

    public function editActionIsFormValid($entity, $data) {
        $uniques = $this->keysUnique();
        $em = $this->getDoctrine()->getManager();

        foreach ($uniques as $attr) {
            $aux = ucfirst($attr);
            $method = 'get' . $aux;
            if (method_exists($entity, $method) && $entity->$method() != $data[$attr]) {
                $exist = $em->getRepository($this->getEntityName())->findOneBy([$attr => $data[$attr]]);
                if (!empty($exist)) {
                    $words = preg_split("/[:]/", $this->getEntityName());
                    $simpleEntityName = $words[1];
                    $message = $this->get('translator')->trans('operation.edit.fail', [
                        '%clazz%' => $simpleEntityName,
                        '%attr%' => $attr,
                        '%value%' => $data[$attr],
                    ], 'common');
                    return ['valid' => false, 'error' => $message];
                }
            }
        }
        return ['valid' => true];
    }
}