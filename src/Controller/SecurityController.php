<?php

namespace App\Controller;

use App\Form\SecurityLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route({"de": "/anmelden", "en": "/login"}, name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // create login form
        $form = $this->createForm(
            SecurityLoginType::class,
            [
                'username' => $lastUsername,
            ]
        );

        return $this->render(
            'security/login.html.twig',
            [
            'form' => $form->createView(),
            'error' => $error, ]
        );
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route({"de": "/security/inaktiv", "en": "/security/inactive"}, name="security_inactive_user")
     */
    public function inactiveUser()
    {
        return $this->render('security/inactive_user.html.twig');
    }
}
