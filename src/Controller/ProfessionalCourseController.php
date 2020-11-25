<?php

namespace App\Controller;

use App\Entity\ProfessionalCourse;
use App\Form\ProfessionalCourseType;
use App\Repository\ProfessionalCourseRepository;
use App\Repository\CvRepository;
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
     * @Route("/new/{idcv}", name="professional_course_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $professionalCourse = new ProfessionalCourse();
        $form = $this->createForm(ProfessionalCourseType::class, $professionalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $professionalCourse->setIdCv($idcvs[0]);
            $entityManager->persist($professionalCourse);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('professional_course/new.html.twig', [
            'professional_course' => $professionalCourse,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="professional_course_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProfessionalCourse $professionalCourse, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(ProfessionalCourseType::class, $professionalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('professional_course/edit.html.twig', [
            'professional_course' => $professionalCourse,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="professional_course_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProfessionalCourse $professionalCourse, CvRepository $CvRepository, $idcv): Response
    {
         $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$professionalCourse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professionalCourse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
