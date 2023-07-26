<?php

namespace App\Controller;

use App\Entity\Baz;
use App\Form\BazType;
use App\Repository\BazRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/baz')]
class BazController extends AbstractController
{
    #[Route('/', name: 'app_baz_index', methods: ['GET'])]
    public function index(BazRepository $bazRepository): Response
    {
        return $this->render('baz/index.html.twig', [
            'bazs' => $bazRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_baz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $baz = new Baz();
        $form = $this->createForm(BazType::class, $baz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($baz);
            $entityManager->flush();

            return $this->redirectToRoute('app_baz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('baz/new.html.twig', [
            'baz' => $baz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_baz_show', methods: ['GET'])]
    public function show(Baz $baz): Response
    {
        return $this->render('baz/show.html.twig', [
            'baz' => $baz,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_baz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Baz $baz, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BazType::class, $baz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_baz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('baz/edit.html.twig', [
            'baz' => $baz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_baz_delete', methods: ['POST'])]
    public function delete(Request $request, Baz $baz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$baz->getId(), $request->request->get('_token'))) {
            $entityManager->remove($baz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_baz_index', [], Response::HTTP_SEE_OTHER);
    }
}
