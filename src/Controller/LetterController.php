<?php

namespace App\Controller;

use App\Form\LetterType;
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
    public function index(Request $request)
    {
        $form = $this->createForm(LetterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = dump($form->getData());

            $name = $data['name'];
            $gender = $data['gender'];

            return $this->render('letter/letter.html.twig', [
                'name' => $name,
                'gender' => $gender
            ]);
        }

        return $this->render('letter/index.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }
}
