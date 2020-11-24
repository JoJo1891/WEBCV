<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\User;
use App\Form\CvType;
use App\Repository\CvRepository;
use App\Repository\InfosPersoRepository;
use App\Repository\ContactInformationRepository;
use App\Repository\SkillsRepository;
use App\Repository\ProfessionalCourseRepository;
use App\Repository\TrainingRepository;
use App\Repository\CenterInterestRepository;
use App\Repository\CertificateRepository;
use App\Repository\LangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/cv")
 */
class CvController extends AbstractController
{
    /**
     * @Route("/", name="cv_index", methods={"GET"})
     */
    public function index(CvRepository $cvRepository): Response
    {
        $user = $this->getUser();
        $users = $user->getId();
        return $this->render('cv/index.html.twig', [
            'cvs' => $cvRepository->findAllByIdUser($users),
        ]);
    }

    /**
     * @Route("/new", name="cv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        
        $user = $this->getUser();

        $cv = new Cv();
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $cv->setIdUser($user);
            $entityManager->persist($cv);
            $entityManager->flush();

            return $this->redirectToRoute('cv_index');

        }

        return $this->render('cv/new.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
            'user' => $users,
            ]);
    }

    /**
     * @Route("/{id}", name="cv_show", methods={"GET"})
     */
    public function show(Cv $cv, InfosPersoRepository $infosPersoRepository, ContactInformationRepository $contactInformationRepository, SkillsRepository $skillsRepository, ProfessionalCourseRepository $ProfessionalCourseRepository, TrainingRepository $trainingRepository, CenterInterestRepository $centerInterestRepository, CertificateRepository $certficateRepository, LangueRepository $langueRepository): Response
    {
        $cvs = $cv->getId();
        return $this->render('cv/show.html.twig', [
            'cv' => $cv,
            'ips' => $infosPersoRepository->findAllByIdCv($cvs),
            'cis'  => $contactInformationRepository->findAllByIdci($cvs),
            'skills' => $skillsRepository->findAllByIdskills($cvs),
            'professional_courses' =>$ProfessionalCourseRepository->findAllByIdProfessionalCourses($cvs),
            'trainings' =>$trainingRepository->findAllByIdTrainings($cvs),
            'center_interests' => $centerInterestRepository->findAllByIdCenterInterests($cvs),
            'certificates' => $certficateRepository->findAllByIdCertificates($cvs),
            'langues' => $langueRepository->findAllByIdLangues($cvs),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cv $cv): Response
    {
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_index');
        }

        return $this->render('cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cv_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cv $cv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_index');
    }
}
