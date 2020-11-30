<?php

namespace App\Controller;

use App\Entity\InfosPerso;
use App\Entity\Cv;
use App\Form\InfosPersoType;
use App\Repository\InfosPersoRepository;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Route("/infos/perso")
 */
class InfosPersoController extends AbstractController
{
    /**
     * @Route("/new/{idcv}", name="infos_perso_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idcv, CvRepository $CvRepository, FileUploader $fileUploader): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $infosPerso = new InfosPerso();
        $form = $this->createForm(InfosPersoType::class, $infosPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile) {
            $avatarFileName = $fileUploader->upload($avatarFile);
            $infosPerso->setavatarFilename($avatarFileName);
            }
        
            $entityManager = $this->getDoctrine()->getManager();
            $infosPerso->setIdCv($idcvs[0]);
            $entityManager->persist($infosPerso);
            $entityManager->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('infos_perso/new.html.twig', [
            'infos_perso' => $infosPerso,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/edit/{idcv}", name="infos_perso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfosPerso $infosPerso, CvRepository $CvRepository, $idcv, FileUploader $fileUploader): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        $form = $this->createForm(InfosPersoType::class, $infosPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $avatarFile = $form->get('avatar')->getData();
            $oldAvatarFile = $form->getData()->getAvatarFilename();

            if ($avatarFile){
                $avatarFileName = $fileUploader->upload($avatarFile);
                if ($oldAvatarFile != null){
                    $del = $fileUploader->deleteUpload($oldAvatarFile);
                }
                $infosPerso->setavatarFilename($avatarFileName);

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
        }

        return $this->render('infos_perso/edit.html.twig', [
            'infos_perso' => $infosPerso,
            'form' => $form->createView(),
            'cv' => $idcvs[0]->getId(),
        ]);
    }

    /**
     * @Route("/{id}/{idcv}", name="infos_perso_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfosPerso $infosPerso, CvRepository $CvRepository, $idcv): Response
    {
        $idcvs = $CvRepository->findBy(['id' =>$idcv]);

        if ($this->isCsrfTokenValid('delete'.$infosPerso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infosPerso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_show', ['id' => $idcvs[0]->getId()]);
    }
}
