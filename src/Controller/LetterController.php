<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LetterController extends AbstractController
{
    /**
     * @Route({"de": "/arztbriefe", "en": "/letter"}, name="letter")
     */
    public function index()
    {
        return $this->render('letter/index.html.twig', [
            'controller_name' => 'LetterController',
        ]);
    }
}
