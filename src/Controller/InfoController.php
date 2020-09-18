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

class InfoController extends AbstractController
{
    /**
     * @Route({"de": "/info", "en": "/info"}, name="info_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('info/index.html.twig', [
            'notes' => $noteRepository->findByCategory('info'),
        ]);
    }

    /**
     * @Route({"de": "/info/erstellen", "en": "/info/new"}, name="info_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('info_index');
        }

        return $this->render('info/new.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('info'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/info/{id}", "en": "/info/{id}"}, name="info_show", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function show(Note $note, NoteRepository $noteRepository): Response
    {
        return $this->render('info/show.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('info'),
        ]);
    }

    /**
     * @Route({"de": "/info/{id}/bearbeiten", "en": "/info/{id}/edit"}, name="info_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Note $note, NoteRepository $noteRepository): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_index');
        }

        return $this->render('info/edit.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('info'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/info/{id}", "en": "/info/{id}"}, name="info_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_index');
    }
}
