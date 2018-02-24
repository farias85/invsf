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
     * Finds and displays a activoFijo entity.
     * @param ActivoFijo $activoFijo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(ActivoFijo $activoFijo) {
        $em = $this->getDoctrine()->getManager();
        $activos = $em->getRepository(Entity::ACTIVO_FIJO)->findBy(['rotulo' => $activoFijo->getRotulo()], ['id' => 'ASC']);
        $apuntes = $em->getRepository(Entity::APUNTE)->findBy(['rotulo' => $activoFijo->getRotulo()], ['id' => 'ASC']);
        return $this->render('FrontendBundle:ActivoFijo:show.html.twig', array(
            'activoFijo' => $activoFijo,
            'activos' => $activos,
            'apuntes' => $apuntes,
        ));
    }

    /**
     * Displays a form to edit an existing activoFijo entity.
     *
     */
    public function editAction(Request $request, ActivoFijo $activoFijo) {
        $editForm = $this->createForm('INV\CommonBundle\Form\ActivoFijoType', $activoFijo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $flash = $request->getSession()->getFlashBag();
            try {
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $flash->add('danger', $this->get('translator')->trans('operation.fail', [], 'common'));
                return $this->redirectToRoute('activo_fijo_index');
            }
            return $this->successRedirect($activoFijo->getId());
        }

        return $this->render('FrontendBundle:ActivoFijo:edit.html.twig', array(
            'activoFijo' => $activoFijo,
            'edit_form' => $editForm->createView(),
        ));
    }

    public function successRedirect($id = null) {
        return $this->get('inv.manager')->successRedirect($id, 'activo_fijo_show', 'activo_fijo_index');
    }
}
