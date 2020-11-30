<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


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
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array(
                'label' => 'Nom',
                'attr' => array('class' => 'validate')))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'attr' => array('class' => 'validate')))
            ->add('objet', TextType::class, array(
                'label' => 'Objet',
                'attr' => array('class' => 'validate')))
            ->add('message', TextareaType::class, array(
                'label' => 'Message',
                'attr' => array('class' => 'validate materialize-textarea')))
            ->add('save', SubmitType::class, ['label' => 'Envoyer', 'attr' => array('class' => 'btn blue wave-effect wave-light')])
            ->getForm();

            $req = $form->handleRequest($request);
            $name = $req->getData()['name'];
            $mail = $req->getData()['email'];
            $objet = $req->getData()['objet'];
            $message = $req->getData()['message'];
        

        if ($form->isSubmitted() && $form->isValid()) {

            $email = (new TemplatedEmail())
                ->from('joel.sylvius18@gmail.com')
                ->text('WEB CV Contact Page')
                ->to('joel.sylvius18@gmail.com')
                ->subject($objet)
                ->html('<h1>'.$name.'</h1><p>'.$mail.'</p><p>'.$message.'</p>')
                
            ;
            $mailer->send($email);
        }

        

        return $this->render('public/contact.html.twig', [
            'form' => $form->createView(),
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

