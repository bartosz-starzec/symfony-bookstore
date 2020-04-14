<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="books_index")
     */
    public function index()
    {
        $books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books
        ]);
    }

    /**
     * @Route("/books/create", name="books_create")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('books_index');
        }

        return $this->render('book/create.form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/books/edit/{id}", name="books_edit")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id): Response
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('books_index');
        }

        return $this->render('book/create.form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("books/delete/{id}", name="books_delete")
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('books_index');
    }
}
