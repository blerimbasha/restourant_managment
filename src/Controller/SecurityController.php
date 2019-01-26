<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use PhpParser\Error;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Tests\Encoder\PasswordEncoder;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error
            ]);
    }

    /**
     * @Route("/resetMyPassword", name="reset_my_password")
     */
    public function resetPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordEncoder = $this->get('security.password_encoder');
            $oldPassword = $request->request->get('reset_password')['oldPassword'];

            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newPasswordEncode = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newPasswordEncode);

                $em->persist($user);
                $em->flush();
                $this->addFlash('success','Your password has been changed');
                return $this->redirectToRoute('homepage');
            } else {
                $form->addError(new FormError('Password in correct'));
            }
        }
        return $this->render('security/resetPassword.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/forgotMyPassword", name="forgot_my_password")
     */
    public function forgotMyPasswordAcion(
        Request $request,
        \Swift_Mailer $mailer,
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
             $email = $request->request->get('forgot_password')['email'];
             $user = $em->getRepository('App:User')->findOneBy(['email' => $email]);

             if (!$user) {
                 $form->addError(new FormError('User not exist'));
             }
            $message = (new \Swift_Message('Helo Email'))
                ->setFrom('blerimi.v@gmail.com')
                ->setTo($email)
                ->setBody($this->renderView('email/forgotMyPassword.html.twig',
                    ['username' => $user->getUsername(),
                        'newPassord' => $randomPassword = mt_rand(100000, 999999)])
                );
            $mailer->send($message);
            $user->setPassword($passwordEncoder->encodePassword($user, $randomPassword));
            $em->persist($user);
            $em->flush();
            $this->addFlash('success','Your new password has been send to email');
            return $this->redirectToRoute('homepage');

        }

        return $this->render('security/forgotPassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
