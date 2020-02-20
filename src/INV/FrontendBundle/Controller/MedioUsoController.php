<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 2/20/2020
 * Time: 3:31 PM
 */

namespace INV\FrontendBundle\Controller;


use INV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MedioUsoController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $medios = $em->getRepository(Entity::MEDIO_USO)->findAll();

        return $this->render('FrontendBundle:MedioUso:index.html.twig', array(
            'medios' => $medios,
        ));
    }
}