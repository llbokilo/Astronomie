<?php

namespace App\Controller;

use App\Entity\Superamas;
use App\Form\SuperamasType;
use App\Repository\SuperamasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/superamas')]
class SuperamasController extends AbstractController
{
    #[Route('/', name: 'superamas_index', methods: ['GET'])]
    public function index(SuperamasRepository $superamasRepository): Response
    {
        return $this->render('superamas/index.html.twig', [
            'superamas' => $superamasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'superamas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $superama = new Superamas();
        $form = $this->createForm(SuperamasType::class, $superama);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($superama);
            $entityManager->flush();

            return $this->redirectToRoute('superamas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('superamas/new.html.twig', [
            'superama' => $superama,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'superamas_show', methods: ['GET'])]
    public function show(Superamas $superama): Response
    {
        return $this->render('superamas/show.html.twig', [
            'superama' => $superama,
        ]);
    }

    #[Route('/{id}/edit', name: 'superamas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Superamas $superama, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuperamasType::class, $superama);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('superamas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('superamas/edit.html.twig', [
            'superama' => $superama,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'superamas_delete', methods: ['POST'])]
    public function delete(Request $request, Superamas $superama, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$superama->getId(), $request->request->get('_token'))) {
            $entityManager->remove($superama);
            $entityManager->flush();
        }

        return $this->redirectToRoute('superamas_index', [], Response::HTTP_SEE_OTHER);
    }
}
