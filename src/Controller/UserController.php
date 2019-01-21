<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('App:User')->findAllUsers($request->query->get('search'));

        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('user/index.html.twig', [
            'users' => $pagination,
            'request' => $request->query->get('search')
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
            try {
                $message = (new \Swift_Message('Helo Email'))
                    ->setFrom('blerimi.v@gmail.com')
                    ->setTo('blerimi_v@msn.com')
                    ->setBody($this->renderView('email/email_new_client.html.twig',
                        ['username' => $user->getUsername(),
                            'password' => $randomPassword = mt_rand(100000, 999999)])
                    );
                $mailer->send($message);
                $user->setPassword($userPasswordEncoder->encodePassword($user, $randomPassword));

                $em->persist($user);
                $em->flush();
                $this->addFlash('success','You User has been created.');
                return $this->redirectToRoute('homepage');
            } catch (\Exception $exception) {
                $this->addFlash('danger','Something went worng');
                error_log($exception->getMessage());
                return $this->redirectToRoute('homepage');

            }

        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
            'request' => $request->query->get('search')
        ]);
    }
}
