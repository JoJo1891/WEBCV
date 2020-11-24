<?php

namespace App\Controller;

use App\Entity\ContactInformation;
use App\Form\ContactInformationType;
use App\Repository\ContactInformationRepository;
use App\Repository\CvRepository;
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
     * @Route("/new/{idcv}", name="contact_information_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $contactInformation = new ContactInformation();
        $form = $this->createForm(ContactInformationType::class, $contactInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $contactInformation->setIdCv($idcvs[0]);
            $entityManager->persist($contactInformation);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
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
     * @Route("/{id}/edit/{idcv}", name="contact_information_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContactInformation $contactInformation, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);
        
        $form = $this->createForm(ContactInformationType::class, $contactInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
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