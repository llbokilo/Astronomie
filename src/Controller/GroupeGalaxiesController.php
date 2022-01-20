<?php

namespace App\Controller;

use App\Entity\GroupeGalaxies;
use App\Form\GroupeGalaxiesType;
use App\Repository\GroupeGalaxiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/groupe/galaxies')]
class GroupeGalaxiesController extends AbstractController
{
    #[Route('/', name: 'groupe_galaxies_index', methods: ['GET'])]
    public function index(GroupeGalaxiesRepository $groupeGalaxiesRepository): Response
    {
        return $this->render('groupe_galaxies/index.html.twig', [
            'groupe_galaxies' => $groupeGalaxiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'groupe_galaxies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $groupeGalaxy = new GroupeGalaxies();
        $form = $this->createForm(GroupeGalaxiesType::class, $groupeGalaxy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($groupeGalaxy);
            $entityManager->flush();

            return $this->redirectToRoute('groupe_galaxies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupe_galaxies/new.html.twig', [
            'groupe_galaxy' => $groupeGalaxy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'groupe_galaxies_show', methods: ['GET'])]
    public function show(GroupeGalaxies $groupeGalaxy): Response
    {
        return $this->render('groupe_galaxies/show.html.twig', [
            'groupe_galaxy' => $groupeGalaxy,
        ]);
    }

    #[Route('/{id}/edit', name: 'groupe_galaxies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GroupeGalaxies $groupeGalaxy, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GroupeGalaxiesType::class, $groupeGalaxy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('groupe_galaxies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupe_galaxies/edit.html.twig', [
            'groupe_galaxy' => $groupeGalaxy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'groupe_galaxies_delete', methods: ['POST'])]
    public function delete(Request $request, GroupeGalaxies $groupeGalaxy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupeGalaxy->getId(), $request->request->get('_token'))) {
            $entityManager->remove($groupeGalaxy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('groupe_galaxies_index', [], Response::HTTP_SEE_OTHER);
    }
}
