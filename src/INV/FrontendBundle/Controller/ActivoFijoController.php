<?php

namespace INV\FrontendBundle\Controller;

use INV\CommonBundle\Entity\ActivoFijo;
use INV\CommonBundle\Entity\Informe;
use INV\CommonBundle\Entity\Usuario;
use INV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

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
        $auditorias = $em->getRepository(Entity::AUDITORIA)->findBy(['rotulo' => $activoFijo->getRotulo(), 'entity' => Entity::ACTIVO_FIJO], ['id' => 'ASC']);
        return $this->render('FrontendBundle:ActivoFijo:show.html.twig', array(
            'activoFijo' => $activoFijo,
            'activos' => $activos,
            'apuntes' => $apuntes,
            'auditorias' => $auditorias,
        ));
    }

    /**
     * Displays a form to edit an existing activoFijo entity.
     * @param Request $request
     * @param ActivoFijo $activoFijo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, ActivoFijo $activoFijo) {
        if (!($this->getUser() instanceof Usuario)) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();

        $aftAntes = '';
        if ($request->isMethod('POST')) {
            $aftAntes = $em->getRepository(Entity::ACTIVO_FIJO)->findForAuditoria($activoFijo->getId());
        }
        $editForm = $this->createForm('INV\CommonBundle\Form\ActivoFijoType', $activoFijo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $em->flush();
                $aftDespues = $em->getRepository(Entity::ACTIVO_FIJO)->findForAuditoria($activoFijo->getId());
                $this->get('inv.auditoria.manager')->create($aftAntes, $aftDespues, $activoFijo->getRotulo(), Entity::ACTIVO_FIJO);
            } catch (\Exception $e) {
                $this->addFlash('danger', $this->get('translator')->trans('operation.fail', [], 'common'));
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

    public function filterAction() {
        $em = $this->getDoctrine()->getManager();

        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionActiva();

        $responsables = $this->findArrayResult(Entity::RESPONSABLE);
        $estados = $this->findArrayResult(Entity::ESTADO);
        $locales = $this->findArrayResult(Entity::LOCAL);
        $tipos = $this->findArrayResult(Entity::TIPO_ACTIVO);

        return $this->render('FrontendBundle:ActivoFijo:filter.html.twig', array(
            'activoFijos' => $activoFijos,
            'responsables' => json_encode($responsables),
            'estados' => json_encode($estados),
            'locales' => json_encode($locales),
            'tipos' => json_encode($tipos),
        ));
    }

    /**
     * @param $entity string
     * @param $orderBy string
     */
    public function findArrayResult($entity, $orderBy = 'nombre') {
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository($entity)
            ->createQueryBuilder('e')
            ->orderBy('e.' . $orderBy, 'ASC')
            ->getQuery()
            ->getArrayResult();
        return $result;
    }

    public function byApuntesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            if (!($this->getUser() instanceof Usuario)) {
                throw $this->createAccessDeniedException();
            }

            $informe = new Informe();
            $informe->setNombre($request->get('nombre'));
            $informe->setFecha(new \DateTime('now'));
            $informe->setCompletado(false);
            $em->persist($informe);
            $em->flush();

            $array = json_decode($request->get('selected'));
            foreach ($array as $item) {
                $item = get_object_vars($item);
                $act = $em->getRepository(Entity::ACTIVO_FIJO)->find($item['id']);
                $informe->addActivo($act);
            }
            $em->flush();
            return $this->redirectToRoute('informe_show', ['id' => $informe->getId()]);
        }

        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionActiva();
        $countApuntes = [];
        $apuntes = [];

        foreach ($activoFijos as $activoFijo) {
//            $countApuntes[] = $em->getRepository(Entity::APUNTE)->findCountByRotulo($activoFijo->getRotulo());
            $result = $em->getRepository(Entity::APUNTE)->findBy(['rotulo' => $activoFijo->getRotulo()], ['fecha' => 'DESC']);
            $countApuntes[] = empty($result) ? 0 : sizeof($result);
            $apuntes[] = empty($result) ? [] : $result;
        }

        return $this->render('FrontendBundle:ActivoFijo:by-apuntes.html.twig', array(
            'activoFijos' => $activoFijos,
            'countApuntes' => $countApuntes,
            'apuntes' => $apuntes,
        ));
    }


}
