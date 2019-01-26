<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Tests\Encoder\PasswordEncoder;

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
        $countUser = $em->getRepository('App:User')->countUsers();

        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('user/index.html.twig', [
            'users' => $pagination,
            'count' => $countUser
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

    /**
     * @Route("/edit/{id}", name="edit_user")
     */
    public function edtAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if (!$user) {
            $this->addFlash('danger','Your User does not exist');
            return $this->redirectToRoute('user');
        }

        if ($form->isSubmitted() && $form->isValid() ) {
            $em->flush();
            $this->addFlash('success','Your User has been edited');
            return $this->redirectToRoute('user');
        }

        return $this->render('user/edit.html.twig',[
            'form' => $form->createView(),
            'request' => $request->query->get('search')
        ]);

    }

    /**
     * @Route("/remove/{id}", name="remove_user")
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);
        if (!$user) {
            $this->addFlash('danger','Your user does not exist');
            return $this->redirectToRoute('user');
        }

        $em->remove($user);
        $em->flush();

        $this->addFlash('success','Your User has been removed.');
        return $this->redirectToRoute('user');
    }

}
