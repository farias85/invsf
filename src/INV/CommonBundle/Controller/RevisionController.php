<?php

namespace INV\CommonBundle\Controller;

use INV\CommonBundle\Entity\Revision;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Revision controller.
 *
 */
class RevisionController extends Controller
{
    /**
     * Lists all revision entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $revisions = $em->getRepository('CommonBundle:Revision')->findAll();

        return $this->render('revision/index.html.twig', array(
            'revisions' => $revisions,
        ));
    }

    /**
     * Creates a new revision entity.
     *
     */
    public function newAction(Request $request)
    {
        $revision = new Revision();
        $form = $this->createForm('INV\CommonBundle\Form\RevisionType', $revision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($revision);
            $em->flush();

            return $this->redirectToRoute('revision_show', array('id' => $revision->getId()));
        }

        return $this->render('revision/new.html.twig', array(
            'revision' => $revision,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a revision entity.
     *
     */
    public function showAction(Revision $revision)
    {
        $deleteForm = $this->createDeleteForm($revision);

        return $this->render('revision/show.html.twig', array(
            'revision' => $revision,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing revision entity.
     *
     */
    public function editAction(Request $request, Revision $revision)
    {
        $deleteForm = $this->createDeleteForm($revision);
        $editForm = $this->createForm('INV\CommonBundle\Form\RevisionType', $revision);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('revision_edit', array('id' => $revision->getId()));
        }

        return $this->render('revision/edit.html.twig', array(
            'revision' => $revision,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a revision entity.
     *
     */
    public function deleteAction(Request $request, Revision $revision)
    {
        $form = $this->createDeleteForm($revision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($revision);
            $em->flush();
        }

        return $this->redirectToRoute('revision_index');
    }

    /**
     * Creates a form to delete a revision entity.
     *
     * @param Revision $revision The revision entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Revision $revision)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('revision_delete', array('id' => $revision->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
