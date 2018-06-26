<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use AppBundle\Form\SubjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Subject controller.
 *
 * @Route("subject")
 */
class SubjectController extends Controller
{
    /**
     * Lists all subject entities.
     *
     * @Route("/", name="subject_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subjects = $em->getRepository(Subject::class)->findAll();

        return $this->render('subject/index.html.twig', array(
            'subjects' => $subjects,
        ));
    }

    /**
     * Creates a new subject entity.
     *
     * @Route("/new", name="subject_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subject);
            $em->flush();

            return $this->redirectToRoute('subject_show', array('id' => $subject->getId()));
        }

        return $this->render('subject/new.html.twig', array(
            'subject' => $subject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subject entity.
     *
     * @Route("/{id}", name="subject_show")
     * @Method("GET")
     */
    public function showAction(Subject $subject)
    {
        return $this->render('subject/show.html.twig', array(
            'subject' => $subject,
        ));
    }

    /**
     * Displays a form to edit an existing subject entity.
     *
     * @Route("/{id}/edit", name="subject_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subject $subject)
    {
        $editForm = $this->createForm(SubjectType::class, $subject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subject_edit', array('id' => $subject->getId()));
        }

        return $this->render('subject/edit.html.twig', array(
            'subject' => $subject,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a subject entity.
     *
     * @Route("/delete/{id}", name="subject_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Subject $subject)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($subject);
        $em->flush();

        return $this->redirectToRoute('subject_index');
    }
}
