<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingController extends AbstractController
{
    /**
     * @Route({"de": "/einarbeitung", "en": "/onboarding"}, name="onboarding_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('onboarding/index.html.twig', [
            'notes' => $noteRepository->findByCategory('onboarding'),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/erstellen", "en": "/onboarding/new"}, name="onboarding_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('onboarding_index');
        }

        return $this->render('onboarding/new.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/{id}", "en": "/onboarding/{id}"}, name="onboarding_show", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function show(Note $note, NoteRepository $noteRepository): Response
    {
        return $this->render('onboarding/show.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/{id}/bearbeiten", "en": "/onboarding/{id}/edit"}, name="onboarding_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Note $note, NoteRepository $noteRepository): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('onboarding_index');
        }

        return $this->render('onboarding/edit.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/{id}", "en": "/onboarding/{id}"}, name="onboarding_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
        }

        return $this->redirectToRoute('onboarding_index');
    }
}
