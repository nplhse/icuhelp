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
class OnboardingController extends AbstractController
{
    /**
     * @Route({"de": "/einarbeitung", "en": "/onboarding"}, name="onboarding_index", methods={"GET"})
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('onboarding/index.html.twig', [
            'notes' => $noteRepository->findByCategory('onboarding'),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/erstellen", "en": "/onboarding/new"}, name="onboarding_new", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(Request $request, NoteRepository $noteRepository, FileUploader $fileUploader): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setCategory('onboarding');
            $note->setPosition(0);

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

            $this->addFlash('success', 'msg.onboarding.added');

            return $this->redirectToRoute('onboarding_show', ['id' => $note->getId()]);
        }

        return $this->render('onboarding/new.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
            'attachments' => null,
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/{id}", "en": "/onboarding/{id}"}, name="onboarding_show", methods={"GET"})
     */
    public function show(Note $note, NoteRepository $noteRepository, UploadRepository $uploadRepository): Response
    {
        return $this->render('onboarding/show.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
            'attachments' => $uploadRepository->findBy([
                'note' => $note,
            ]),
        ]);
    }

    /**
     * @Route({"de": "/einarbeitung/{id}/bearbeiten", "en": "/onboarding/{id}/edit"}, name="onboarding_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, Note $note, NoteRepository $noteRepository, UploadRepository $uploadRepository, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            if (!$note->getUploads()->isEmpty()) {
                $arrayCollection = $note->getUploads();

                foreach ($arrayCollection as $i => $file) {
                    $file->setPath('notes');

                    if ($file->getFile()) {
                        $upload = $fileUploader->upload($file);
                        $entityManager->persist($upload);
                    }
                }
            }

            $entityManager->persist($note);
            $entityManager->flush();

            $this->addFlash('success', 'msg.onboarding.edited');

            return $this->redirectToRoute('onboarding_show', ['id' => $note->getId()]);
        }

        return $this->render('onboarding/edit.html.twig', [
            'note' => $note,
            'notes' => $noteRepository->findByCategory('onboarding'),
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
            'attachments' => $uploadRepository->findBy([
                'note' => $note,
            ]),
        ]);
    }

    /**
     * @Route("/_onboarding/reorder/notes", name="onboarding_reorder_notes", methods="POST")
     */
    public function reorderNotes(Request $request, NoteRepository $noteRepository)
    {
        $orderedIds = json_decode($request->getContent(), true);

        if (null === $orderedIds) {
            return $this->json(['detail' => 'Invalid body'], 400);
        }

        $notes = $noteRepository->findByCategory('onboarding');

        // from (position)=>(id) to (id)=>(position)
        $orderedIds = array_flip($orderedIds);

        foreach ($notes as $note) {
            $note->setPosition($orderedIds[$note->getId()]);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json(
            null,
            200,
            [],
            [
                'groups' => ['main'],
            ]
        );
    }

    /**
     * @Route({"de": "/einarbeitung/{id}", "en": "/onboarding/{id}"}, name="onboarding_delete", methods={"DELETE"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
        }

        $this->addFlash('danger', 'msg.onboarding.deleted');

        return $this->redirectToRoute('onboarding_index');
    }
}
