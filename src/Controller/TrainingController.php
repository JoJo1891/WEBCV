<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/training")
 */
class TrainingController extends AbstractController
{
    /**
     * @Route("/new/{idcv}", name="training_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $training->setIdCv($idcvs[0]);
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('training/edit.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="training_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Training $training, CvRepository $CvRepository, $idcv): Response
    {
         $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
