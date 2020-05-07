<?php

namespace App\Controller;

use App\Form\LetterType;
use App\Service\LetterBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LetterController extends AbstractController
{
    /**
     * @Route({"de": "/arztbriefe", "en": "/letter"}, name="letter")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, LetterBuilder $letterBuilder)
    {
        $form = $this->createForm(LetterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = dump($form->getData());

            //$snippets = $this->fetchSnippets($data->getSnippets());

            $letter = $letterBuilder->build($data);

            return $this->render('letter/letter.html.twig', [
                'snippets' => $letter,
            ]);
        }

        return $this->render('letter/index.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    private function fetchSnippets($snippets)
    {
    }
}
