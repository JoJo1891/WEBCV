<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{
	/**
    * @Route("/")
    */
    public function home(): Response
    {
        $number = random_int(0, 100);

        return $this->render('public/home.html.twig', [
            'number' => $number,
        ]);
    }
}

