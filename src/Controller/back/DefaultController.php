<?php
namespace App\Controller\back;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use FOS\ElasticaBundle\Finder\TransformedFinder;

/**
 * @Route("/back")
 *
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
	/**
    * @Route("/", name="app_admin_home")
    */
    public function home(): Response
    {

        return $this->render('back/home.html.twig');
    }

    /**
    * @Route("/search", name="app_admin_search_cv")
    */
    public function searchCV(Request $request, SessionInterface $session, TransformedFinder $cvFinder, TransformedFinder $certificateFinder, TransformedFinder $centerinterestFinder, TransformedFinder $contactinformationFinder, TransformedFinder $infospersoFinder, TransformedFinder $langueFinder, TransformedFinder $professionalcourseFinder, TransformedFinder $skillsFinder, TransformedFinder $trainingFinder): Response
    {

        $form = $this->createFormBuilder()
            ->add('search', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'rechercher'])
            ->getForm();

        $req = $form->handleRequest($request);
        $results = null;
        $resultscertif = null;
        $resultscenter = null;
        $resultscontact = null;
        $resultsinfos = null;
        $resultslangue = null;
        $resultsprofe = null;
        $resultsskills = null;
        $resultstraining = null;
        $q = $req->getData()["search"];
        
        

        if ($form->isSubmitted() && $form->isValid()) {

            $results = !empty($q) ? $cvFinder->findHybrid($q) : [];
            $resultscertif = !empty($q) ? $certificateFinder->findHybrid($q) : [];
            $resultscenter = !empty($q) ? $centerinterestFinder->findHybrid($q) : [];
            $resultscontact = !empty($q) ? $contactinformationFinder->findHybrid($q) : [];
            $resultsinfos = !empty($q) ? $infospersoFinder->findHybrid($q) : [];
            $resultslangue = !empty($q) ? $langueFinder->findHybrid($q) : [];
            $resultsprofe = !empty($q) ? $professionalcourseFinder->findHybrid($q) : [];
            $resultsskills = !empty($q) ? $skillsFinder->findHybrid($q) : [];
            $resultstraining = !empty($q) ? $trainingFinder->findHybrid($q) : [];
            
        }

        return $this->render('back/searchcv.html.twig', [
            'results' => $results,
            'resultscertif' => $resultscertif,
            'resultscenter' => $resultscenter,
            'resultscontact' => $resultscontact,
            'resultsinfos' => $resultsinfos,
            'resultslangue' => $resultslangue,
            'resultsprofe' => $resultsprofe,
            'resultsskills' => $resultsskills,
            'resultstraining' => $resultstraining,
            'form' => $form->createView(),
        ]);
    }

    
}

