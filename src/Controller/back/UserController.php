<?php

namespace App\Controller\back;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/back/user")
 * @IsGranted("ROLE_ADMIN")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET", "POST"})
     */
    public function index(UserRepository $userRepository, Request $request, SessionInterface $session,TransformedFinder $userFinder): Response
    {
        $form = $this->createFormBuilder()
            ->add('search', TextType::class, array(
                'attr' => array('class' => 'validate center-align white-text')))
            ->add('save', SubmitType::class, ['label' => 'Go', 'attr' => array('class' => 'btn btn-small blue-text transparent')])
            ->getForm();

        $req = $form->handleRequest($request);
        $results = null;
        
        $q = $req->getData()["search"];
        
        

        if ($form->isSubmitted() && $form->isValid()) {

            $results = !empty($q) ? $userFinder->findHybrid($q) : [];
            
            
        }


        return $this->render('back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'user' => $results,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/filtre/{val}", name="user_filter", methods={"GET", "POST"})
    */
    public function filter($val, UserRepository $userRepository): Response
    {
        $vals = [];
        if($val == "ROLE_ADMIN"){
            $vals = $userRepository->findAllByRAValue();
        }
        else if($val == "ROLE_USER"){
            $vals = $userRepository->findAllByRUValue();
        }
        else if($val == "ROLE_USER_ADMIN"){
            $vals = $userRepository->findAllByRUAValue();
        }
        else if($val == "asc"){
            $vals = $userRepository->findBy(array(), array('name' => 'ASC'));
        }
        else if($val == "desc"){
            $vals = $userRepository->findBy(array(), array('name' => 'DESC'));
        }

        $form = $this->createFormBuilder()
            ->add('search', TextType::class, array(
                'attr' => array('class' => 'validate center-align white-text')))
            ->add('save', SubmitType::class, ['label' => 'Go', 'attr' => array('class' => 'btn btn-small blue-text transparent')])
            ->getForm();

        return $this->render('back/user/index.html.twig', [
            'users' => $vals,
            'user' => "",
            'form' => $form->createView(),
        ]);
        
    }

    

    /**
    * @Route("/{id}/switch/{roles}", name="switch_role", methods={"GET", "POST"})
    */
    public function switchRole($roles, UserRepository $userRepository, User $user, $id, MailerInterface $mailer): Response
    {
        $role = "";
        $vals = [];
        if($roles == "ROLE_ADMIN"){
            $role = ["ROLE_ADMIN"];
            $vals = $userRepository->findAllByRAValue();
        }
        else if($roles == "ROLE_USER"){
            $role = ["ROLE_USER"];
            $vals = $userRepository->findAllByRUValue();
        }
        else if($roles == "ROLE_USER_ADMIN"){
            $role = ["ROLE_USER_ADMIN"];
            $vals = $userRepository->findAllByRUAValue();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $usr = $userRepository->findOneById($id);
        $usr->setRoles($role);
        $entityManager->persist($usr);
        $entityManager->flush();

        $email = (new TemplatedEmail())
            ->from(new Address('contacts.webcv@gmail.com', 'WEB CV Informations'))
            ->to($usr->getEmail())
            ->subject('Changement de privilège')
            ->htmlTemplate('back/user/email.html.twig')
            ->context([
                'role' => $role[0],
            ])
        ;

        $mailer->send($email);

        return $this->render('back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);

    }


    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
