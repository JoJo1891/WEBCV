<?php

namespace App\Controller;

use App\Entity\CenterInterest;
use App\Form\CenterInterestType;
use App\Repository\CenterInterestRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/center/interest")
 */
class CenterInterestController extends AbstractController
{
    /**
     * @Route("/new/{idcv}", name="center_interest_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $centerInterest = new CenterInterest();
        $form = $this->createForm(CenterInterestType::class, $centerInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $centerInterest->setIdCv($idcvs[0]);
            $entityManager->persist($centerInterest);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('center_interest/new.html.twig', [
            'center_interest' => $centerInterest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="center_interest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CenterInterest $centerInterest, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(CenterInterestType::class, $centerInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('center_interest/edit.html.twig', [
            'center_interest' => $centerInterest,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="center_interest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CenterInterest $centerInterest, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$centerInterest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($centerInterest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
