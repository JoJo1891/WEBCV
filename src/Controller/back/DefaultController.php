<?php
// src/Controller/LuckyController.php
namespace App\Controller\back;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    
}

