<?php

namespace App\Controller;

use App\Entity\SuperamasGalaxies;
use App\Form\SuperamasGalaxiesType;
use App\Repository\SuperamasGalaxiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/superamas_galaxies')]
class SuperamasGalaxiesController extends AbstractController
{
    #[Route('/', name: 'superamas_galaxies_index', methods: ['GET'])]
    public function index(SuperamasGalaxiesRepository $superamasGalaxiesRepository): Response
    {
        return $this->render('superamas_galaxies/index.html.twig', [
            'superamas_galaxies' => $superamasGalaxiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'superamas_galaxies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $superamasGalaxy = new SuperamasGalaxies();
        $form = $this->createForm(SuperamasGalaxiesType::class, $superamasGalaxy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($superamasGalaxy);
            $entityManager->flush();

            return $this->redirectToRoute('superamas_galaxies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('superamas_galaxies/new.html.twig', [
            'superamas_galaxy' => $superamasGalaxy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'superamas_galaxies_show', methods: ['GET'])]
    public function show(SuperamasGalaxies $superamasGalaxy): Response
    {
        return $this->render('superamas_galaxies/show.html.twig', [
            'superamas_galaxy' => $superamasGalaxy,
        ]);
    }

    #[Route('/{id}/edit', name: 'superamas_galaxies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuperamasGalaxies $superamasGalaxy, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuperamasGalaxiesType::class, $superamasGalaxy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('superamas_galaxies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('superamas_galaxies/edit.html.twig', [
            'superamas_galaxy' => $superamasGalaxy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'superamas_galaxies_delete', methods: ['POST'])]
    public function delete(Request $request, SuperamasGalaxies $superamasGalaxy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$superamasGalaxy->getId(), $request->request->get('_token'))) {
            $entityManager->remove($superamasGalaxy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('superamas_galaxies_index', [], Response::HTTP_SEE_OTHER);
    }
}
