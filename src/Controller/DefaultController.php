<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{
	/**
    * @Route("/", name="app_home")
    */
    public function home(): Response
    {
        $number = random_int(0, 100);

        return $this->render('public/home.html.twig', [
            'number' => $number,
        ]);
    }

    /**
    * @Route("/contact", name="app_contact")
    */
    public function contact(): Response
    {
        $number = random_int(0, 100);

        return $this->render('public/contact.html.twig', [
            'number' => $number,
        ]);
    }

    /**
    * @Route("/about", name="app_about")
    */
    public function about(): Response
    {
        $number = random_int(0, 100);

        return $this->render('public/about.html.twig', [
            'number' => $number,
        ]);
    }
}

