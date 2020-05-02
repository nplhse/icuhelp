<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LetterController extends AbstractController
{
    /**
     * @Route({"de": "/arztbriefe", "en": "/letter"}, name="letter")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->render('letter/index.html.twig', [
            'controller_name' => 'LetterController',
        ]);
    }
}
