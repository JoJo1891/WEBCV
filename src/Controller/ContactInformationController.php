<?php

namespace App\Controller;

use App\Entity\ContactInformation;
use App\Form\ContactInformationType;
use App\Repository\ContactInformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/information")
 */
class ContactInformationController extends AbstractController
{
    /**
     * @Route("/", name="contact_information_index", methods={"GET"})
     */
    public function index(ContactInformationRepository $contactInformationRepository): Response
    {
        return $this->render('contact_information/index.html.twig', [
            'contact_informations' => $contactInformationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contact_information_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contactInformation = new ContactInformation();
        $form = $this->createForm(ContactInformationType::class, $contactInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactInformation);
            $entityManager->flush();

            return $this->redirectToRoute('contact_information_index');
        }

        return $this->render('contact_information/new.html.twig', [
            'contact_information' => $contactInformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_information_show", methods={"GET"})
     */
    public function show(ContactInformation $contactInformation): Response
    {
        return $this->render('contact_information/show.html.twig', [
            'contact_information' => $contactInformation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_information_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContactInformation $contactInformation): Response
    {
        $form = $this->createForm(ContactInformationType::class, $contactInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_information_index');
        }

        return $this->render('contact_information/edit.html.twig', [
            'contact_information' => $contactInformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_information_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ContactInformation $contactInformation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactInformation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactInformation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_information_index');
    }
}
