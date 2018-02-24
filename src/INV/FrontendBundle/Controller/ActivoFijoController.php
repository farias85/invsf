<?php

namespace INV\FrontendBundle\Controller;

use INV\CommonBundle\Entity\ActivoFijo;
use INV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Activofijo controller.
 *
 */
class ActivoFijoController extends Controller {
    /**
     * Lists all activoFijo entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionActiva();

        return $this->render('FrontendBundle:ActivoFijo:index.html.twig', array(
            'activoFijos' => $activoFijos,
        ));
    }

    /**
     * Creates a new activoFijo entity.
     *
     */
    public function newAction(Request $request) {
        $activoFijo = new Activofijo();
        $form = $this->createForm('INV\CommonBundle\Form\ActivoFijoType', $activoFijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activoFijo);
            $em->flush();

            return $this->redirectToRoute('activo_fijo_show', array('id' => $activoFijo->getId()));
        }

        return $this->render('activofijo/new.html.twig', array(
            'activoFijo' => $activoFijo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activoFijo entity.
     *
     */
    public function showAction(ActivoFijo $activoFijo) {
        $deleteForm = $this->createDeleteForm($activoFijo);

        return $this->render('activofijo/show.html.twig', array(
            'activoFijo' => $activoFijo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing activoFijo entity.
     *
     */
    public function editAction(Request $request, ActivoFijo $activoFijo) {
        $deleteForm = $this->createDeleteForm($activoFijo);
        $editForm = $this->createForm('INV\CommonBundle\Form\ActivoFijoType', $activoFijo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activo_fijo_edit', array('id' => $activoFijo->getId()));
        }

        return $this->render('activofijo/edit.html.twig', array(
            'activoFijo' => $activoFijo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a activoFijo entity.
     *
     */
    public function deleteAction(Request $request, ActivoFijo $activoFijo) {
        $form = $this->createDeleteForm($activoFijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activoFijo);
            $em->flush();
        }

        return $this->redirectToRoute('activo_fijo_index');
    }

    /**
     * Creates a form to delete a activoFijo entity.
     *
     * @param ActivoFijo $activoFijo The activoFijo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ActivoFijo $activoFijo) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activo_fijo_delete', array('id' => $activoFijo->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
