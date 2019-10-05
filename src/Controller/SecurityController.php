<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\Model\ChangePassword;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
            return $this->redirectToRoute('user_show', ['id' => $this->getUser()->getId()]);
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("{id}/change-password", name="change_password", methods={"GET","POST"})
     */
    public function changePassword(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(ChangePasswordType::class, new ChangePassword());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             if ($passwordEncoder->isPasswordValid($user, $form->get('oldPassword')->getData())) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $form->get('newPassword')->getData());
                $user->setPassword($newEncodedPassword);

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
                $entityManager->refresh($user);

                return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }

        return $this->render('user/changePassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
