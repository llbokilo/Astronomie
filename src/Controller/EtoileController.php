<?php

namespace App\Controller;

use App\Entity\Etoile;
use App\Form\EtoileType;
use App\Repository\EtoileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etoile')]
class EtoileController extends AbstractController
{
    #[Route('/', name: 'etoile_index', methods: ['GET'])]
    public function index(EtoileRepository $etoileRepository): Response
    {
        return $this->render('etoile/index.html.twig', [
            'etoiles' => $etoileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'etoile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etoile = new Etoile();
        $form = $this->createForm(EtoileType::class, $etoile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etoile);
            $entityManager->flush();

            return $this->redirectToRoute('etoile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etoile/new.html.twig', [
            'etoile' => $etoile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'etoile_show', methods: ['GET'])]
    public function show(Etoile $etoile): Response
    {
        return $this->render('etoile/show.html.twig', [
            'etoile' => $etoile,
        ]);
    }

    #[Route('/{id}/edit', name: 'etoile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etoile $etoile, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtoileType::class, $etoile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('etoile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etoile/edit.html.twig', [
            'etoile' => $etoile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'etoile_delete', methods: ['POST'])]
    public function delete(Request $request, Etoile $etoile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etoile->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etoile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etoile_index', [], Response::HTTP_SEE_OTHER);
    }
}
