<?php

namespace App\Controller;

use App\Entity\Satellite;
use App\Form\SatelliteType;
use App\Repository\SatelliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/satellite')]
class SatelliteController extends AbstractController
{
    #[Route('/', name: 'satellite_index', methods: ['GET'])]
    public function index(SatelliteRepository $satelliteRepository): Response
    {
        return $this->render('satellite/index.html.twig', [
            'satellites' => $satelliteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'satellite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $satellite = new Satellite();
        $form = $this->createForm(SatelliteType::class, $satellite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($satellite);
            $entityManager->flush();

            return $this->redirectToRoute('satellite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('satellite/new.html.twig', [
            'satellite' => $satellite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'satellite_show', methods: ['GET'])]
    public function show(Satellite $satellite): Response
    {
        return $this->render('satellite/show.html.twig', [
            'satellite' => $satellite,
        ]);
    }

    #[Route('/{id}/edit', name: 'satellite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Satellite $satellite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SatelliteType::class, $satellite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('satellite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('satellite/edit.html.twig', [
            'satellite' => $satellite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'satellite_delete', methods: ['POST'])]
    public function delete(Request $request, Satellite $satellite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$satellite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($satellite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('satellite_index', [], Response::HTTP_SEE_OTHER);
    }
}
