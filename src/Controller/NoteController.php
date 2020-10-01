<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use App\Repository\UploadRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class NoteController extends AbstractController
{
    /**
     * @Route({"de": "/notizen", "en": "/notes"}, name="note_index", methods={"GET"})
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('note/index.html.twig', [
            'notes' => $noteRepository->findByCategory('note'),
        ]);
    }

    /**
     * @Route({"de": "/notizen/erstellen", "en": "/notes/new"}, name="note_new", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(Request $request, NoteRepository $noteRepository, FileUploader $fileUploader): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setCategory('note');

            $entityManager = $this->getDoctrine()->getManager();

            if (!$note->getUploads()->isEmpty()) {
                $arrayCollection = $note->getUploads();

                foreach ($arrayCollection as $i => $file) {
                    $file->setPath('notes');

                    $upload = $fileUploader->upload($file);
                    $entityManager->persist($upload);
                }
            }

            $entityManager->persist($note);
            $entityManager->flush();

            $this->addFlash('success', 'msg.note.added');

            return $this->redirectToRoute('note_show', ['id' => $note->getId()]);
        }

        return $this->render('note/new.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('note'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/notizen/{id}", "en": "/notes/{id}"}, name="note_show", methods={"GET"})
     */
    public function show(Note $note, NoteRepository $noteRepository, UploadRepository $uploadRepository): Response
    {
        return $this->render('note/show.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('note'),
            'attachments' => $uploadRepository->findBy([
                'note' => $note,
            ]),
        ]);
    }

    /**
     * @Route({"de": "/notizen/{id}/bearbeiten", "en": "/notes/{id}/edit"}, name="note_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, Note $note, NoteRepository $noteRepository, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            if (!$note->getUploads()->isEmpty()) {
                $arrayCollection = $note->getUploads();

                foreach ($arrayCollection as $i => $file) {
                    $file->setPath('notes');

                    $upload = $fileUploader->upload($file);
                    $entityManager->persist($upload);
                }
            }

            $entityManager->persist($note);
            $entityManager->flush();

            $this->addFlash('success', 'msg.note.edited');

            return $this->redirectToRoute('note_show', ['id' => $note->getId()]);
        }

        return $this->render('note/edit.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('note'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/notizen/{id}", "en": "/notes/{id}"}, name="note_delete", methods={"DELETE"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
        }

        $this->addFlash('danger', 'msg.note.deleted');

        return $this->redirectToRoute('note_index');
    }
}
