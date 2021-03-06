<?php

namespace App\Controller;

use App\Entity\SOP;
use App\Form\SOPType;
use App\Repository\SOPRepository;
use App\Repository\SOPTagRepository;
use App\Service\LegacyFileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class SOPController extends AbstractController
{
    /**
     * @Route({"de": "/standards", "en": "/sop"}, name="sop_index", methods={"GET"})
     */
    public function index(SOPRepository $SOPRepository, SOPTagRepository $SOPTagRepository, Request $request): Response
    {
        $q = $request->query->get('q');

        return $this->render('sop/index.html.twig', [
            'sops' => $SOPRepository->findAllByName($q),
            'tag' => null,
            'tags' => $SOPTagRepository->findByNameAlphabetically(),
            'q' => $q,
        ]);
    }

    /**
     * @Route({"de": "/standards/tag:{tag}", "en": "/sop/tag:{tag}"}, name="sop_filteredbytag", methods={"GET"})
     */
    public function filteredIndex(SOPRepository $SOPRepository, SOPTagRepository $SOPTagRepository, Request $request, $tag): Response
    {
        $q = $request->query->get('q');

        return $this->render('sop/index.html.twig', [
            'sops' => $SOPRepository->findAllByTag($tag, $q),
            'tag' => $tag,
            'tags' => $SOPTagRepository->findByNameAlphabetically(),
            'q' => $q,
        ]);
    }

    /**
     * @Route({"de": "/standards/neu", "en": "/sop/new"}, name="sop_new", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(Request $request, LegacyFileUploader $fileUploader): Response
    {
        $SOP = new SOP();
        $form = $this->createForm(SOPType::class, $SOP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $SOPFile */
            $SOPFile = $form->get('sopFile')->getData();

            if ($SOPFile) {
                $SOPFileName = $fileUploader->upload($SOPFile);
                $SOP->setSOPFilename($SOPFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($SOP);
            $entityManager->flush();

            $this->addFlash('success', 'msg.sop.added');

            return $this->redirectToRoute('sop_show', ['id' => $SOP->getId()]);
        }

        return $this->render('sop/new.html.twig', [
            'sop' => $SOP,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route({"de": "/standards/{id}", "en": "/sop/{id}"}, name="sop_show", methods={"GET"})
     */
    public function show(SOP $SOP): Response
    {
        return $this->render('sop/show.html.twig', [
            'sop' => $SOP,
        ]);
    }

    /**
     * @Route({"de": "/standards/{id}/bearbeiten", "en": "/sop/{id}/edit"}, name="sop_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, SOP $SOP): Response
    {
        $form = $this->createForm(SOPType::class, $SOP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'msg.sop.edited');

            return $this->redirectToRoute('sop_show', ['id' => $SOP->getId()]);
        }

        return $this->render('sop/edit.html.twig', [
            'sop' => $SOP,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route({"de": "/standards/{id}", "en": "/sop/{id}"}, name="sop_delete", methods={"DELETE"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function delete(Request $request, SOP $SOP): Response
    {
        if ($this->isCsrfTokenValid('delete'.$SOP->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($SOP);
            $entityManager->flush();
        }

        $this->addFlash('danger', 'msg.sop.deleted');

        return $this->redirectToRoute('sop_index');
    }
}
