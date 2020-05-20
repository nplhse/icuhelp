<?php

namespace App\Controller;

use App\Entity\Snippet;
use App\Entity\SnippetCategory;
use App\Form\SnippetFormType;
use App\Repository\SnippetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SnippetController extends AbstractController
{
    /**
     * @Route({"de": "/arztbriefe/textbausteine", "en": "/letter/snippets"}, name="snippet_list")
     * @IsGranted("ROLE_USER")
     */
    public function listSnippets(Request $request, SnippetRepository $snippetRepository)
    {
        return $this->render('letter/snippets/list.html.twig', [
            'snippets' => $snippetRepository->findOrderedByPriority(),
        ]);
    }

    /**
     * @Route({"de": "/arztbriefe/textbausteine/neu", "en": "/letter/snippets/new"}, name="snippet_new")
     * @IsGranted("ROLE_USER")
     */
    public function newSnippet(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(SnippetFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snippet = $form->getData();

            $em->persist($snippet);
            $em->flush();

            $this->addFlash('success', 'msg.snippet.added');

            return $this->redirectToRoute('snippet_list');
        }

        return $this->render('letter/snippets/new.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/arztbriefe/textbausteine/{id}", "en": "/letter/snippets/{id}"}, name="snippet_edit")
     * @IsGranted("ROLE_USER")
     */
    public function editSnippet(Snippet $snippet, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(SnippetFormType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($snippet);
            $em->flush();

            $this->addFlash('primary', 'msg.snippet.edited');

            return $this->redirectToRoute('snippet_list');
        }

        return $this->render('letter/snippets/edit.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/arztbriefe/textbausteine/{id}/delete", "en": "/letter/snippets/{id}/delete"}, name="snippet_delete")
     * @IsGranted("ROLE_USER")
     */
    public function deleteSnippet(Snippet $snippet, Request $request, EntityManagerInterface $em)
    {
        $em->remove($snippet);
        $em->flush();

        $this->addFlash('danger', 'msg.snippet.deleted');

        return $this->redirectToRoute('snippet_list');
    }
}
