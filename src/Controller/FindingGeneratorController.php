<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FindingGeneratorController extends AbstractController
{
    /**
     * @Route("/findings", name="finding_generator")
     */
    public function index()
    {
        return $this->render('finding_generator/index.html.twig');
    }
}
