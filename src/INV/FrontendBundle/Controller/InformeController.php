<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 25/02/2018
 * Time: 19:17
 */

namespace INV\FrontendBundle\Controller;


use INV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InformeController extends Controller {

    public function showAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $informe = $em->getRepository(Entity::INFORME)->find($id);
        $activoFijos = $informe->getActivos();

        return $this->render('FrontendBundle:Informe:show.html.twig', array(
            'activoFijos' => $activoFijos,
            'informe' => $informe,
        ));
    }

    public function newChequeoAction(Request $request, $idInforme, $idActivo) {
        $form = $this->createForm('INV\CommonBundle\Form\ChequeoType');
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $informe = $em->getRepository(Entity::INFORME)->find($idInforme);
        $activoFijo = $em->getRepository(Entity::ACTIVO_FIJO)->find($idActivo);

        if ($form->isSubmitted() && $form->isValid()) {

//            $apunte->setUsuario($this->getUser());
//            $apunte->setRotulo($activoFijo->getRotulo());
//            $apunte->setFecha(new \DateTime('now'));
//
//            $em->persist($apunte);
//            $em->flush();

            return $this->redirectToRoute('informe_show', array('id' => $idInforme));
        }

        return $this->render('FrontendBundle:Apunte:new.html.twig', array(
            'informe' => $informe,
            'form' => $form->createView(),
            'activoFijo' => $activoFijo
        ));
    }
}