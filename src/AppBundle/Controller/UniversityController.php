<?php

namespace AppBundle\Controller;

use AppBundle\Entity\University;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * University controller.
 *
 * @Route("university")
 */
class UniversityController extends Controller
{
    /**
     * Lists all university entities.
     *
     * @Route("/", name="university_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $universities = $em->getRepository('AppBundle:University')->findAll();

        return $this->render('university/index.html.twig', array(
            'universities' => $universities,
        ));
    }

    /**
     * Creates a new university entity.
     *
     * @Route("/new", name="university_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $university = new University();
        $form = $this->createForm('AppBundle\Form\UniversityType', $university);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($university);
            $em->flush();

            return $this->redirectToRoute('university_show', array('id' => $university->getId()));
        }

        return $this->render('university/new.html.twig', array(
            'university' => $university,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a university entity.
     *
     * @Route("/{id}", name="university_show")
     * @Method("GET")
     */
    public function showAction(University $university)
    {
        $deleteForm = $this->createDeleteForm($university);

        return $this->render('university/show.html.twig', array(
            'university' => $university,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing university entity.
     *
     * @Route("/{id}/edit", name="university_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, University $university)
    {
        $deleteForm = $this->createDeleteForm($university);
        $editForm = $this->createForm('AppBundle\Form\UniversityType', $university);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('university_edit', array('id' => $university->getId()));
        }

        return $this->render('university/edit.html.twig', array(
            'university' => $university,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a university entity.
     *
     * @Route("/{id}", name="university_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, University $university)
    {
        $form = $this->createDeleteForm($university);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($university);
            $em->flush();
        }

        return $this->redirectToRoute('university_index');
    }

    /**
     * Creates a form to delete a university entity.
     *
     * @param University $university The university entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(University $university)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('university_delete', array('id' => $university->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
