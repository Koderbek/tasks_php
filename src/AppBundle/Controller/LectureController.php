<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lecture;
use AppBundle\Form\LectureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Lecture controller.
 *
 * @Route("lecture")
 */
class LectureController extends Controller
{
    /**
     * Lists all lecture entities.
     *
     * @Route("/", name="lecture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lectures = $em->getRepository(Lecture::class)->findAll();

        return $this->render('lecture/index.html.twig', array(
            'lectures' => $lectures,
        ));
    }

    /**
     * Creates a new lecture entity.
     *
     * @Route("/new", name="lecture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lecture = new Lecture();
        $form = $this->createForm(LectureType::class, $lecture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lecture);
            $em->flush();

            return $this->redirectToRoute('lecture_show', array('id' => $lecture->getId()));
        }

        return $this->render('lecture/new.html.twig', array(
            'lecture' => $lecture,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lecture entity.
     *
     * @Route("/{id}", name="lecture_show")
     * @Method("GET")
     */
    public function showAction(Lecture $lecture)
    {
        return $this->render('lecture/show.html.twig', array(
            'lecture' => $lecture,
        ));
    }

    /**
     * Displays a form to edit an existing lecture entity.
     *
     * @Route("/{id}/edit", name="lecture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lecture $lecture)
    {
        $editForm = $this->createForm(LectureType::class, $lecture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lecture_edit', array('id' => $lecture->getId()));
        }

        return $this->render('lecture/edit.html.twig', array(
            'lecture' => $lecture,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a lecture entity.
     *
     * @Route("/delete/{id}", name="lecture_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Lecture $lecture)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($lecture);
        $em->flush();

        return $this->redirectToRoute('lecture_index');
    }
}
