<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactCategoryRepository;
use App\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 * @IsGranted("ROLE_USER")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods={"GET"})
     */
    public function index(ContactRepository $contactRepository, ContactCategoryRepository $contactCategoryRepository, Request $request): Response
    {
        $q = $request->query->get('q');

        return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAllByName($q),
            'category' => null,
            'categories' => $contactCategoryRepository->findByNameAlphabetically(),
            'q' => $q,
        ]);
    }

    /**
     * @Route("/category:{category}", name="contact_filteredbycat", methods={"GET"})
     */
    public function filteredIndex(ContactRepository $contactRepository, ContactCategoryRepository $contactCategoryRepository, Request $request, $category): Response
    {
        $q = $request->query->get('q');

        return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAllByCategory($category, $q),
            'category' => $category,
            'categories' => $contactCategoryRepository->findByNameAlphabetically(),
            'q' => $q,
        ]);
    }

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'msg.contact.added');

            return $this->redirectToRoute('contact_show', ['id' => $contact->getId()]);
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'msg.contact.edited');

            return $this->redirectToRoute('contact_show', ['id' => $contact->getId()]);
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"DELETE"})
     * @IsGranted("ROLE_EDITOR")
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        $this->addFlash('success', 'msg.contact.deleted');

        return $this->redirectToRoute('contact_index');
    }
}
