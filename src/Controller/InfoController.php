<?php

namespace App\Controller;

use App\Entity\Info;
use App\Form\InfoType;
use App\Repository\InfoRepository;
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
    public function index(InfoRepository $infoRepository): Response
    {
        return $this->render('info/index.html.twig', [
            'infos' => $infoRepository->findOrderedInfos(),
        ]);
    }

    /**
     * @Route({"de": "/info/erstellen", "en": "/info/new"}, name="info_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, InfoRepository $infoRepository): Response
    {
        $info = new Info();
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($info);
            $entityManager->flush();

            return $this->redirectToRoute('info_index');
        }

        return $this->render('info/new.html.twig', [
            'info' => $info,
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/info/{id}", "en": "/info/{id}"}, name="info_show", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function show(Info $info, InfoRepository $infoRepository): Response
    {
        return $this->render('info/show.html.twig', [
            'info' => $info,
        ]);
    }

    /**
     * @Route({"de": "/info/{id}/bearbeiten", "en": "/info/{id}/edit"}, name="info_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Info $info, InfoRepository $infoRepository): Response
    {
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_index');
        }

        return $this->render('info/edit.html.twig', [
            'info' => $info,
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/info/{id}", "en": "/info/{id}"}, name="info_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Info $info): Response
    {
        if ($this->isCsrfTokenValid('delete'.$info->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($info);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_index');
    }
}
