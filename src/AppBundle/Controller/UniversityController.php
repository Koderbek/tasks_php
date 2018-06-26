<?php

namespace AppBundle\Controller;

use AppBundle\Entity\University;
use AppBundle\Form\UniversityType;
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

        $universities = $em->getRepository(University::class)->findAll();

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
        $form = $this->createForm(UniversityType::class, $university);
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
        return $this->render('university/show.html.twig', array(
            'university' => $university,
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
        $editForm = $this->createForm(UniversityType::class, $university);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('university_edit', array('id' => $university->getId()));
        }

        return $this->render('university/edit.html.twig', array(
            'university' => $university,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a university entity.
     *
     * @Route("/delete/{id}", name="university_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, University $university)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($university);
        $em->flush();

        return $this->redirectToRoute('university_index');
    }
}
