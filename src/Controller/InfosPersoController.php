<?php

namespace App\Controller;

use App\Entity\InfosPerso;
use App\Form\InfosPersoType;
use App\Repository\InfosPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/infos/perso")
 */
class InfosPersoController extends AbstractController
{
    /**
     * @Route("/", name="infos_perso_index", methods={"GET"})
     */
    public function index(InfosPersoRepository $infosPersoRepository): Response
    {
        return $this->render('infos_perso/index.html.twig', [
            'infos_persos' => $infosPersoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="infos_perso_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infosPerso = new InfosPerso();
        $form = $this->createForm(InfosPersoType::class, $infosPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infosPerso);
            $entityManager->flush();

            return $this->redirectToRoute('infos_perso_index');
        }

        return $this->render('infos_perso/new.html.twig', [
            'infos_perso' => $infosPerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infos_perso_show", methods={"GET"})
     */
    public function show(InfosPerso $infosPerso): Response
    {
        return $this->render('infos_perso/show.html.twig', [
            'infos_perso' => $infosPerso,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="infos_perso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfosPerso $infosPerso): Response
    {
        $form = $this->createForm(InfosPersoType::class, $infosPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infos_perso_index');
        }

        return $this->render('infos_perso/edit.html.twig', [
            'infos_perso' => $infosPerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infos_perso_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfosPerso $infosPerso): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infosPerso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infosPerso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('infos_perso_index');
    }
}
