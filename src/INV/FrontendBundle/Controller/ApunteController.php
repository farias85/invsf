<?php

namespace INV\FrontendBundle\Controller;

use INV\CommonBundle\Entity\Apunte;
use INV\CommonBundle\Entity\Usuario;
use INV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Apunte controller.
 *
 */
class ApunteController extends Controller {
    /**
     * Lists all apunte entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $apuntes = $em->getRepository(Entity::APUNTE)->findAll();

        return $this->render('FrontendBundle:Apunte:index.html.twig', array(
            'apuntes' => $apuntes,
        ));
    }

    /**
     * Crea un apunte de control
     * @param Request $request
     * @param $idActivo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newControlAction(Request $request, $idActivo) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $activoFijo = $em->getRepository(Entity::ACTIVO_FIJO)->find($idActivo);
        $this->get('inv.apunte.manager')->create($activoFijo->getRotulo());

        return $this->redirectToRoute('activo_fijo_show', array('id' => $idActivo));
    }

    /**
     * Creates a new apunte entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $idActivo) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }

        $apunte = new Apunte();
        $form = $this->createForm('INV\CommonBundle\Form\ApunteType', $apunte);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $activoFijo = $em->getRepository(Entity::ACTIVO_FIJO)->find($idActivo);

        if ($form->isSubmitted() && $form->isValid()) {

            $apunte->setUsuario($this->getUser());
            $apunte->setRotulo($activoFijo->getRotulo());
            $apunte->setFecha(new \DateTime('now'));

            $em->persist($apunte);
            $em->flush();

            return $this->redirectToRoute('activo_fijo_show', array('id' => $idActivo));
        }

        return $this->render('FrontendBundle:Apunte:new.html.twig', array(
            'apunte' => $apunte,
            'form' => $form->createView(),
            'activoFijo' => $activoFijo
        ));
    }

    /**
     * Finds and displays a apunte entity.
     *
     */
    public function showAction(Apunte $apunte) {
        return $this->render('FrontendBundle:Apunte:show.html.twig', array(
            'apunte' => $apunte,
        ));
    }

    /**
     * Displays a form to edit an existing apunte entity.
     * @param Request $request
     * @param Apunte $apunte
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Apunte $apunte) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }

        $editForm = $this->createForm('INV\CommonBundle\Form\ApunteType', $apunte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apunte_show', array('id' => $apunte->getId()));
        }

        return $this->render('FrontendBundle:Apunte:edit.html.twig', array(
            'apunte' => $apunte,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a apunte entity.
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $apunte = $em->getRepository(Entity::APUNTE)->find($id);

        try {
            $this->get('inv.apunte.manager')->remove($apunte);
        } catch (\Exception $e) {
            $this->addFlash('danger', $this->get('translator')->trans('operation.fail', [], 'common'));
        }

        return $this->redirectToRoute('apunte_index');
    }

    public function deleteFromAftAction(Request $request, $id, $idActivo) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $apunte = $em->getRepository(Entity::APUNTE)->find($id);

        try {
            $this->get('inv.apunte.manager')->remove($apunte);
        } catch (\Exception $e) {
            $this->addFlash('danger', $this->get('translator')->trans('operation.fail', [], 'common'));
        }

        return $this->redirectToRoute('activo_fijo_show', ['id' => $idActivo]);
    }


}
