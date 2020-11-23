<?php

namespace App\Controller;

use App\Entity\CenterInterest;
use App\Form\CenterInterestType;
use App\Repository\CenterInterestRepository;
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
     * @Route("/", name="center_interest_index", methods={"GET"})
     */
    public function index(CenterInterestRepository $centerInterestRepository): Response
    {
        return $this->render('center_interest/index.html.twig', [
            'center_interests' => $centerInterestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="center_interest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $centerInterest = new CenterInterest();
        $form = $this->createForm(CenterInterestType::class, $centerInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centerInterest);
            $entityManager->flush();

            return $this->redirectToRoute('center_interest_index');
        }

        return $this->render('center_interest/new.html.twig', [
            'center_interest' => $centerInterest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="center_interest_show", methods={"GET"})
     */
    public function show(CenterInterest $centerInterest): Response
    {
        return $this->render('center_interest/show.html.twig', [
            'center_interest' => $centerInterest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="center_interest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CenterInterest $centerInterest): Response
    {
        $form = $this->createForm(CenterInterestType::class, $centerInterest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('center_interest_index');
        }

        return $this->render('center_interest/edit.html.twig', [
            'center_interest' => $centerInterest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="center_interest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CenterInterest $centerInterest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centerInterest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($centerInterest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('center_interest_index');
    }
}
