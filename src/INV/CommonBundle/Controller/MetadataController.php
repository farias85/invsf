<?php

namespace INV\CommonBundle\Controller;

use INV\CommonBundle\Entity\Metadata;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Metadata controller.
 *
 */
class MetadataController extends Controller
{
    /**
     * Lists all metadata entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $metadata = $em->getRepository('CommonBundle:Metadata')->findAll();

        return $this->render('metadata/index.html.twig', array(
            'metadata' => $metadata,
        ));
    }

    /**
     * Creates a new metadata entity.
     *
     */
    public function newAction(Request $request)
    {
        $metadata = new Metadata();
        $form = $this->createForm('INV\CommonBundle\Form\MetadataType', $metadata);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metadata);
            $em->flush();

            return $this->redirectToRoute('metadata_show', array('id' => $metadata->getId()));
        }

        return $this->render('metadata/new.html.twig', array(
            'metadata' => $metadata,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a metadata entity.
     *
     */
    public function showAction(Metadata $metadata)
    {
        $deleteForm = $this->createDeleteForm($metadata);

        return $this->render('metadata/show.html.twig', array(
            'metadata' => $metadata,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing metadata entity.
     *
     */
    public function editAction(Request $request, Metadata $metadata)
    {
        $deleteForm = $this->createDeleteForm($metadata);
        $editForm = $this->createForm('INV\CommonBundle\Form\MetadataType', $metadata);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metadata_edit', array('id' => $metadata->getId()));
        }

        return $this->render('metadata/edit.html.twig', array(
            'metadata' => $metadata,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a metadata entity.
     *
     */
    public function deleteAction(Request $request, Metadata $metadata)
    {
        $form = $this->createDeleteForm($metadata);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metadata);
            $em->flush();
        }

        return $this->redirectToRoute('metadata_index');
    }

    /**
     * Creates a form to delete a metadata entity.
     *
     * @param Metadata $metadata The metadata entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Metadata $metadata)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metadata_delete', array('id' => $metadata->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
