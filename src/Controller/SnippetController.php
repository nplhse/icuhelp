<?php

namespace App\Controller;

use App\Entity\Snippet;
use App\Form\SnippetFormType;
use App\Repository\SnippetRepository;
use App\Service\SnippetHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SnippetController extends AbstractController
{
    /**
     * @Route({"de": "/textbausteine", "en": "/snippets"}, name="snippet_index")
     */
    public function index(Request $request, SnippetRepository $snippetRepository, SnippetHelper $snippetHelper)
    {
        $snippets = $snippetRepository->findOrderedByPriority();
        $snippets = $snippetHelper->sortSnippets($snippets);

        return $this->render('snippets/index.html.twig', [
            'snippets' => $snippets,
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/neu", "en": "/snippets/new"}, name="snippet_new")
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(SnippetFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snippet = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($snippet);
            $em->flush();

            $this->addFlash('success', 'msg.snippet.added');

            return $this->redirectToRoute('snippet_show', ['id' => $snippet->getId()]);
        }

        return $this->render('snippets/new.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/{id}", "en": "/snippets/{id}"}, name="snippet_show", methods={"GET"})
     */
    public function show(Snippet $snippet): Response
    {
        return $this->render('snippets/show.html.twig', [
            'snippet' => $snippet,
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/{id}/edit", "en": "/snippets/{id}"}, name="snippet_edit")
     * @IsGranted("ROLE_EDITOR")
     */
    public function edit(Snippet $snippet, Request $request)
    {
        $form = $this->createForm(SnippetFormType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($snippet);
            $em->flush();

            $this->addFlash('primary', 'msg.snippet.edited');

            return $this->redirectToRoute('snippet_show', ['id' => $snippet->getId()]);
        }

        return $this->render('snippets/edit.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/{id}/delete", "en": "/snippets/{id}/delete"}, name="snippet_delete")
     * @IsGranted("ROLE_EDITOR")
     */
    public function delete(Snippet $snippet, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$snippet->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($snippet);
            $em->flush();
        }

        $this->addFlash('danger', 'msg.snippet.deleted');

        return $this->redirectToRoute('snippet_index');
    }
}
