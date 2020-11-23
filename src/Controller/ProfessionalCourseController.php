<?php

namespace App\Controller;

use App\Entity\ProfessionalCourse;
use App\Form\ProfessionalCourseType;
use App\Repository\ProfessionalCourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professional/course")
 */
class ProfessionalCourseController extends AbstractController
{
    /**
     * @Route("/", name="professional_course_index", methods={"GET"})
     */
    public function index(ProfessionalCourseRepository $professionalCourseRepository): Response
    {
        return $this->render('professional_course/index.html.twig', [
            'professional_courses' => $professionalCourseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="professional_course_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $professionalCourse = new ProfessionalCourse();
        $form = $this->createForm(ProfessionalCourseType::class, $professionalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professionalCourse);
            $entityManager->flush();

            return $this->redirectToRoute('professional_course_index');
        }

        return $this->render('professional_course/new.html.twig', [
            'professional_course' => $professionalCourse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professional_course_show", methods={"GET"})
     */
    public function show(ProfessionalCourse $professionalCourse): Response
    {
        return $this->render('professional_course/show.html.twig', [
            'professional_course' => $professionalCourse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="professional_course_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProfessionalCourse $professionalCourse): Response
    {
        $form = $this->createForm(ProfessionalCourseType::class, $professionalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professional_course_index');
        }

        return $this->render('professional_course/edit.html.twig', [
            'professional_course' => $professionalCourse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professional_course_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProfessionalCourse $professionalCourse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professionalCourse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professionalCourse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('professional_course_index');
    }
}
