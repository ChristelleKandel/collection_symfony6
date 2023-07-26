<?php

namespace App\Controller;

use App\Entity\Foo;
use App\Form\FooType;
use App\Repository\FooRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/foo')]
class FooController extends AbstractController
{
    #[Route('/', name: 'app_foo_index', methods: ['GET'])]
    public function index(FooRepository $fooRepository): Response
    {
        return $this->render('foo/index.html.twig', [
            'foos' => $fooRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_foo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $foo = new Foo();
        $form = $this->createForm(FooType::class, $foo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($foo);
            $entityManager->flush();

            return $this->redirectToRoute('app_foo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('foo/new.html.twig', [
            'foo' => $foo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foo_show', methods: ['GET'])]
    public function show(Foo $foo): Response
    {
        return $this->render('foo/show.html.twig', [
            'foo' => $foo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_foo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Foo $foo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FooType::class, $foo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_foo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('foo/edit.html.twig', [
            'foo' => $foo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foo_delete', methods: ['POST'])]
    public function delete(Request $request, Foo $foo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($foo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_foo_index', [], Response::HTTP_SEE_OTHER);
    }
}
