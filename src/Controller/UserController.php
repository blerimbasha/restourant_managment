<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new", name="new_client")
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, \Swift_Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
         $form = $this->createForm(UserType::class, $user);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
//             $randomPassword = mt_rand(100000, 999999);
             $message = (new \Swift_Message('Helo Email'))
                 ->setFrom('blerimi.v@gmail.com')
                 ->setTo('arba_18@hotmail.com','blerimi_v@msn.com')
                 ->setBody($this->renderView('email/new_client.html.twig',
                 ['username' => $user->getUsername(),
                    'password' => $randomPassword = mt_rand(100000, 999999)])
                 );
             $mailer->send($message);
             $user->setPassword($userPasswordEncoder->encodePassword($user,$randomPassword));

             $em->persist($user);
             $em->flush();
             return $this->redirectToRoute('homepage');
         }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
