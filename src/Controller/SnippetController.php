<?php

namespace App\Controller;

use App\Entity\Snippet;
use App\Form\SnippetFormType;
use App\Repository\SnippetRepository;
use App\Service\SnippetHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SnippetController extends AbstractController
{
    /**
     * @Route({"de": "/textbausteine", "en": "/snippets"}, name="snippets")
     * @IsGranted("ROLE_USER")
     */
    public function listSnippets(Request $request, SnippetRepository $snippetRepository, SnippetHelper $snippetHelper)
    {
        $snippets = $snippetRepository->findOrderedByPriority();
        $snippets = $snippetHelper->sortSnippets($snippets);

        return $this->render('snippets/list.html.twig', [
            'snippets' => $snippets,
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/neu", "en": "/snippets/new"}, name="snippet_new")
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

            return $this->redirectToRoute('snippets');
        }

        return $this->render('snippets/new.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/{id}", "en": "/snippets/{id}"}, name="snippet_edit")
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

            return $this->redirectToRoute('snippets');
        }

        return $this->render('snippets/edit.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, false),
        ]);
    }

    /**
     * @Route({"de": "/textbausteine/{id}/delete", "en": "/snippets/{id}/delete"}, name="snippet_delete")
     * @IsGranted("ROLE_USER")
     */
    public function deleteSnippet(Snippet $snippet, Request $request, EntityManagerInterface $em)
    {
        $em->remove($snippet);
        $em->flush();

        $this->addFlash('danger', 'msg.snippet.deleted');

        return $this->redirectToRoute('snippets');
    }

    private function compareSnippets($obj1, $obj2)
    {
        return $obj1->getPriority() > $obj2->getPriority();
    }
}
