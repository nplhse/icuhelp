<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route({"de": "/startseite", "en": "/homepage"}, name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig');
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function start()
    {
        return $this->redirectToRoute('homepage');
    }
}
