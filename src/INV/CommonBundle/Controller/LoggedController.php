<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 23/02/2018
 * Time: 18:55
 */

namespace INV\CommonBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoggedController extends Controller {

    /**
     * @return bool
     */
    public function isLogged() {
        return !empty($this->getUser());
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectForbidden() {
        $request = $this->get('inv.manager')->getRequest();
        $flash = $request->getSession()->getFlashBag();
        $flash->add('danger', $this->get('translator')->trans('forbidden'));
        return $this->redirectToRoute('frontend_homepage');
    }
}