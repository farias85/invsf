<?php

namespace INV\FrontendBundle\Controller;

use INV\CommonBundle\Controller\LoggedController;
use INV\CommonBundle\Entity\Apunte;
use INV\CommonBundle\Util\Entity;
use Symfony\Component\HttpFoundation\Request;

/**
 * Apunte controller.
 *
 */
class ApunteController extends LoggedController {
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
        if (!$this->isLogged()) {
            return $this->redirectForbidden();
        }
        $em = $this->getDoctrine()->getManager();
        $activoFijo = $em->getRepository(Entity::ACTIVO_FIJO)->find($idActivo);
        $apunte = new Apunte();
        $apunte->setUsuario($this->getUser());
        $apunte->setRotulo($activoFijo->getRotulo());
        $apunte->setAsunto('Control');
        $apunte->setObservacion('Control');
        $apunte->setFecha(new \DateTime('now'));
        $em->persist($apunte);
        $em->flush();
        return $this->redirectToRoute('activo_fijo_show', array('id' => $idActivo));
    }

    /**
     * Creates a new apunte entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $idActivo) {
        if (!$this->isLogged()) {
            return $this->redirectForbidden();
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

        if (!$this->isLogged()) {
            return $this->redirectForbidden();
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
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {

        if (!$this->isLogged()) {
            return $this->redirectForbidden();
        }

        $em = $this->getDoctrine()->getManager();
        $apunte = $em->getRepository(Entity::APUNTE)->find($id);
        $chequeos = $em->getRepository(Entity::CHEQUEO)->findBy(['apunte' => $apunte]);
        foreach ($chequeos as $chequeo) {
            $em->remove($chequeo);
        }
        $em->remove($apunte);
        $em->flush();
        return $this->redirectToRoute('apunte_index');
    }
}
