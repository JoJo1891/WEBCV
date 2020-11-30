<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skills")
 */
class SkillsController extends AbstractController
{

    /**
     * @Route("/new/{idcv}", name="skills_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $skill = new Skills();
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $skill->setIdCv($idcvs[0]);
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('skills/new.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="skills_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Skills $skill, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('skills/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="skills_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Skills $skill, CvRepository $CvRepository, $idcv): Response
    {
         $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
