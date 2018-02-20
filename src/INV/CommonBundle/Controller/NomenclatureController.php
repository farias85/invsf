<?php

namespace INV\CommonBundle\Controller;

use INV\CommonBundle\Extension\EntityNameExtension;
use INV\CommonBundle\Form\NomenclatureType;
use INV\CommonBundle\Manager\Manager;
use Symfony\Component\HttpFoundation\Request;

abstract class NomenclatureController extends CommonController implements EntityNameExtension {

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    abstract public function getRoutePrefix();

    public function getRouteNew() {
        return $this->getRoutePrefix() . '_new';
    }

    public function getRouteEdit() {
        return $this->getRoutePrefix() . '_edit';
    }

    public function getRouteDelete() {
        return $this->getRoutePrefix() . '_delete';
    }

    public function getRouteIndex() {
        return $this->getRoutePrefix() . '_index';
    }

    public function getRouteShow() {
        return $this->getRoutePrefix() . '_show';
    }

    /**
     * El class name de la clase formulario que va a renderizarse en el new y en el edit
     * @return string
     */
    public function getFormTypeClass() {
        return NomenclatureType::class;
    }

    /**
     * El full path del directorio donde se encuentra la entidad
     * @return string
     */
    private function getBundleEntityFullPath() {
        $words = preg_split("/[:]/", $this->getEntityName());
        $bundleName = $words[0];
        return 'INV\\' . $bundleName . '\Entity\\';
    }

    /**
     * Propocionar el manager de la entidad, si lo tiene, sino con devolver sf.manager está bien, sino null.
     * @return Manager
     */
    public function getManager() {
        return $this->get('inv.nomenclature.manager');
    }

    /**
     * Proporcionar un string con el nombre del path de la carpeta donde estarán las
     * vistas del CRUD, por ejemplo BackendBundle:CuidadorEstado
     * @return string
     */
    public function getResourceViewPath() {
        return 'BackendBundle:Nomenclature';
    }

    public function getRouter() {
        return array(
            'index' => $this->getRouteIndex(),
            'new' => $this->getRouteNew(),
            'edit' => $this->getRouteEdit(),
            'show' => $this->getRouteShow(),
            'delete' => $this->getRouteDelete(),
        );
    }

    public function defaultKeysFilter() {
        return array('id' => 'text', 'nombre' => 'text', 'descripcion' => 'text',);
    }

    public function defaultKeysI18n() {
        return array('id' => $this->get('translator')->trans('nomenclador.id', [], 'common'),
            'nombre' => $this->get('translator')->trans('nomenclador.nombre', [], 'common'),
            'descripcion' => $this->get('translator')->trans('nomenclador.descripcion', [], 'common')
        );
    }

    public function keysFilterOnIndex() {
        return $this->defaultKeysFilter();
    }

    public function keysI18nOnIndex() {
        return $this->defaultKeysI18n();
    }

    public function keysFilterOnShow() {
        return $this->keysFilterOnIndex();
    }

    public function keysI18nOnShow() {
        return $this->keysI18nOnIndex();
    }

    public function keysI18nOnFormType() {
        return $this->keysI18nOnIndex();
    }

    private function display(array $keysFilter, array $keysI18n) {
        $result = [];
        $words = preg_split("/[:]/", $this->getEntityName());
        $entityName = lcfirst($words[1]);
        foreach ($keysFilter as $key => $filter) {
            $result[$key] = array(
                'trans' => empty($keysI18n[$key])
                    ? $this->get('translator')->trans($key, [], $entityName . '-i18n')
                    : $keysI18n[$key],
                'filter' => $filter,
            );
        }
        return $result;
    }

    private function findViewParams($entity, $displayKeys) {

        $hasEl = false;
        $hasTrans = false;
        if (!empty($entity)) {
            $hasEl = method_exists($entity, 'getEl')
                && method_exists($entity, 'setEl');
            $hasTrans = method_exists($entity, 'getTranslates')
                && method_exists($entity, 'setTranslates');
        } else {
            return array(
                'hasEl' => $hasEl,
                'hasTrans' => $hasTrans,
                'entityKeys' => $displayKeys,
                'entityLangKeys' => [],
            );
        }

        $dismountEntity = $this->getManager()->dismount($entity);
        $entityKeys = [];
        foreach ($dismountEntity as $key => $value) {
            if (!empty($displayKeys[$key])) {
                $entityKeys[$key] = $displayKeys[$key];
            }
        }

        $dismountEntityLang = !empty($hasEl) ? $this->getManager()->dismount($entity->getAny()) : [];

        $entityLangKeys = [];
        foreach ($dismountEntityLang as $key => $value) {
            if (strcasecmp($key, 'id') != 0 && !empty($displayKeys[$key])) {
                $entityLangKeys[$key] = $displayKeys[$key];
            }
        }

        return array(
            'hasEl' => $hasEl,
            'hasTrans' => $hasTrans,
            'entityKeys' => $entityKeys,
            'entityLangKeys' => $entityLangKeys,
        );
    }

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository($this->getEntityName())->findAll();

        $filtersOnIndex = $this->keysFilterOnIndex();
        $i18nOnIndex = $this->keysI18nOnIndex();
        $viewParams = $this->findViewParams(empty($entities) ? null : $entities[0], $filtersOnIndex);

        return $this->render($this->getResourceViewPath() . ':index.html.twig', array(
            'entities' => $entities,
            'viewParams' => $viewParams,
            'display' => $this->display($filtersOnIndex, $i18nOnIndex),
            'name' => $this->getNameIndex(),
            'router' => $this->getRouter(),
            'title' => $this->getTitle(),
        ));
    }

    /**
     * Si devuelve false detiene el submit del formulario del newAction
     * @param array $data
     * @param string $fullEntityName
     * @return mixed Array [valid => true|false, error => 'message']. Se chequea la variable error en caso de que valid
     * sólo sea false
     */
    public function newActionIsFormValid($fullEntityName, $data) {
        return ['valid' => true];
    }

    /**
     * El método se ejecuta en un closoure antes de hacer flush a la entidad $entity con los datos $data del formulario
     * @param $entity
     * @param $data
     */
    public function newActionBeforeFlush($entity, $data) {
    }

    /**
     * El método se ejecuta en el controlador despues de hacer flush a la entidad $entity con los datos $data del formulario
     * @param $entity
     * @param $data
     */
    public function newActionAfterFlush($entity, $data) {
    }

    public function newAction(Request $request) {
        $form = $this->createForm($this->getFormTypeClass(), array(
            'display' => $this->keysI18nOnFormType()
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $words = preg_split("/[:]/", $this->getEntityName());
            $simpleEntityName = $words[1];
            $fullEntityName = $this->getBundleEntityFullPath() . $simpleEntityName;

            $data = $form->getData();
            $data['fullEntityName'] = $fullEntityName;

            $isValid = $this->newActionIsFormValid($fullEntityName, $data);
            if (empty($isValid['valid'])) {
                $flash = $request->getSession()->getFlashBag();
                $message = !empty($isValid['error']) ? $isValid['error'] : $this->get('translator')->trans('operation.new.fail.default', [], 'common');
                $flash->add('danger', $message);

                $entity = new $fullEntityName();
                $this->get('inv.entitysetter')->fromData($entity, $data);

                $form = $this->createForm($this->getFormTypeClass(), array(
                    'entity' => $entity,
                    'display' => $this->keysI18nOnFormType()
                ));

                return $this->render($this->getResourceViewPath() . ':new.html.twig', array(
                    'form' => $form->createView(),
                    'name' => $this->getNameNew(),
                    'router' => $this->getRouter(),
                ));
            }

            $beforeFlush = function ($entity, $data) {
                $this->newActionBeforeFlush($entity, $data);
            };
            $entity = $this->getManager()->save($data, $beforeFlush);
            $this->newActionAfterFlush($entity, $data);

            return $this->successRedirect($entity->getId());
        }

        return $this->render($this->getResourceViewPath() . ':new.html.twig', array(
            'form' => $form->createView(),
            'name' => $this->getNameNew(),
            'router' => $this->getRouter(),
        ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);

        $filtersOnShow = $this->keysFilterOnShow();
        $i18nOnShow = $this->keysI18nOnShow();
        $viewParams = $this->findViewParams(empty($entity) ? null : $entity, $filtersOnShow);

        return $this->render($this->getResourceViewPath() . ':show.html.twig', array(
            'entity' => $entity,
            'viewParams' => $viewParams,
            'display' => $this->display($filtersOnShow, $i18nOnShow),
            'router' => $this->getRouter(),
            'name' => $this->getNameShow(),
        ));
    }

    /**
     * El método se ejecuta en un closoure antes de hacer flush a la entidad $entity con los datos $data del formulario
     * @param $entity
     * @param $data
     */
    public function editActionBeforeFlush($entity, $data) {
    }

    /**
     * El método se ejecuta en el controlador despues de hacer flush a la entidad $entity con los datos $data del formulario
     * @param $entity
     * @param $data
     */
    public function editActionAfterFlush($entity, $data) {
    }

    /**
     * Si devuelve false detiene el submit del formulario del editAction
     * @param array $data
     * @param mixed $entity
     * @return mixed Array [valid => true|false, error => 'message']. Se chequea la variable error en caso de que valid
     * sólo sea false
     */
    public function editActionIsFormValid($entity, $data) {
        return ['valid' => true];
    }

    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);
        $editForm = $this->createForm($this->getFormTypeClass(), array(
            'entity' => $entity,
            'display' => $this->keysI18nOnFormType()
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $data = $editForm->getData();

            $isValid = $this->editActionIsFormValid($entity, $data);
            if (empty($isValid['valid'])) {
                $flash = $request->getSession()->getFlashBag();
                $message = !empty($isValid['error']) ? $isValid['error'] : $this->get('translator')->trans('operation.edit.fail.default', [], 'common');
                $flash->add('danger', $message);

                $this->get('inv.entitysetter')->fromData($entity, $data);

                $editForm = $this->createForm($this->getFormTypeClass(), array(
                    'entity' => $entity,
                    'display' => $this->keysI18nOnFormType()
                ));

                return $this->render($this->getResourceViewPath() . ':edit.html.twig', array(
                    'entity' => $entity,
                    'router' => $this->getRouter(),
                    'edit_form' => $editForm->createView(),
                    'name' => $this->getNameEdit(),
                ));
            }

            $beforeFlush = function ($entity, $data) {
                $this->editActionBeforeFlush($entity, $data);
            };

            $this->getManager()->edit($entity, $data, $beforeFlush);
            $this->editActionAfterFlush($entity, $data);
            return $this->successRedirect($entity->getId());
        }

        return $this->render($this->getResourceViewPath() . ':edit.html.twig', array(
            'entity' => $entity,
            'router' => $this->getRouter(),
            'edit_form' => $editForm->createView(),
            'name' => $this->getNameEdit(),
        ));
    }

    public function deleteActionBeforeFlush($entity) {
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);
        if (!empty($entity)) {
            $this->remove(function () use ($entity) {
                $beforeFlush = function ($entity) {
                    $this->deleteActionBeforeFlush($entity);
                };
                $this->getManager()->remove($entity, $beforeFlush);
            });
        }
        return $this->redirectToRoute($this->getRouteIndex());
    }
}
