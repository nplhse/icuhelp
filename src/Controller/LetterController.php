<?php

namespace App\Controller;

use App\Form\LetterType;
use App\Service\LetterBuilder;
use App\Service\SnippetHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class LetterController extends AbstractController
{
    /**
     * @Route({"de": "/arztbriefe", "en": "/letter"}, name="letter")
     * @IsGranted("ROLE_USER")
     */
    public function letter(Request $request, LetterBuilder $letterBuilder, SnippetHelper $snippetHelper)
    {
        $form = $this->createForm(LetterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $letterDTO = $form->getData();

            return $this->render('letter/letter.html.twig', [
                'snippets' => $letter = $letterBuilder->build($letterDTO, $snippetHelper),
            ]);
        }

        return $this->render('letter/form.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }
}
