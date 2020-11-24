<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/langue")
 */
class LangueController extends AbstractController
{
    /**
     * @Route("/", name="langue_index", methods={"GET"})
     */
    public function index(LangueRepository $langueRepository): Response
    {
        return $this->render('langue/index.html.twig', [
            'langues' => $langueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{idcv}", name="langue_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $langue = new Langue();
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $langue->setIdCv($idcvs[0]);
            $entityManager->persist($langue);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('langue/new.html.twig', [
            'langue' => $langue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="langue_show", methods={"GET"})
     */
    public function show(Langue $langue): Response
    {
        return $this->render('langue/show.html.twig', [
            'langue' => $langue,
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="langue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Langue $langue, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('langue/edit.html.twig', [
            'langue' => $langue,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="langue_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Langue $langue, CvRepository $CvRepository, $idcv): Response
    {
         $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$langue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($langue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
