<?php

namespace App\Controller;

use App\Entity\Certificate;
use App\Form\CertificateType;
use App\Repository\CertificateRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/certificate")
 */
class CertificateController extends AbstractController
{
    /**
     * @Route("/new/{idcv}", name="certificate_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $certificate = new Certificate();
        $form = $this->createForm(CertificateType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $certificate->setIdCv($idcvs[0]);
            $entityManager->persist($certificate);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('certificate/new.html.twig', [
            'certificate' => $certificate,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="certificate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Certificate $certificate, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(CertificateType::class, $certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('certificate/edit.html.twig', [
            'certificate' => $certificate,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="certificate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Certificate $certificate, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$certificate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($certificate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
