<?php

namespace App\Controller;

use App\Entity\SystemePlanetaire;
use App\Form\SystemePlanetaireType;
use App\Repository\SystemePlanetaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/systeme/planetaire')]
class SystemePlanetaireController extends AbstractController
{
    #[Route('/', name: 'systeme_planetaire_index', methods: ['GET'])]
    public function index(SystemePlanetaireRepository $systemePlanetaireRepository): Response
    {
        return $this->render('systeme_planetaire/index.html.twig', [
            'systeme_planetaires' => $systemePlanetaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'systeme_planetaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $systemePlanetaire = new SystemePlanetaire();
        $form = $this->createForm(SystemePlanetaireType::class, $systemePlanetaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($systemePlanetaire);
            $entityManager->flush();

            return $this->redirectToRoute('systeme_planetaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('systeme_planetaire/new.html.twig', [
            'systeme_planetaire' => $systemePlanetaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'systeme_planetaire_show', methods: ['GET'])]
    public function show(SystemePlanetaire $systemePlanetaire): Response
    {
        return $this->render('systeme_planetaire/show.html.twig', [
            'systeme_planetaire' => $systemePlanetaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'systeme_planetaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SystemePlanetaire $systemePlanetaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SystemePlanetaireType::class, $systemePlanetaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('systeme_planetaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('systeme_planetaire/edit.html.twig', [
            'systeme_planetaire' => $systemePlanetaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'systeme_planetaire_delete', methods: ['POST'])]
    public function delete(Request $request, SystemePlanetaire $systemePlanetaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$systemePlanetaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($systemePlanetaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('systeme_planetaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
