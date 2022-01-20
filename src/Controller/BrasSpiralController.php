<?php

namespace App\Controller;

use App\Entity\BrasSpiral;
use App\Form\BrasSpiralType;
use App\Repository\BrasSpiralRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bras/spiral')]
class BrasSpiralController extends AbstractController
{
    #[Route('/', name: 'bras_spiral_index', methods: ['GET'])]
    public function index(BrasSpiralRepository $brasSpiralRepository): Response
    {
        return $this->render('bras_spiral/index.html.twig', [
            'bras_spirals' => $brasSpiralRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'bras_spiral_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $brasSpiral = new BrasSpiral();
        $form = $this->createForm(BrasSpiralType::class, $brasSpiral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($brasSpiral);
            $entityManager->flush();

            return $this->redirectToRoute('bras_spiral_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bras_spiral/new.html.twig', [
            'bras_spiral' => $brasSpiral,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bras_spiral_show', methods: ['GET'])]
    public function show(BrasSpiral $brasSpiral): Response
    {
        return $this->render('bras_spiral/show.html.twig', [
            'bras_spiral' => $brasSpiral,
        ]);
    }

    #[Route('/{id}/edit', name: 'bras_spiral_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BrasSpiral $brasSpiral, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BrasSpiralType::class, $brasSpiral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bras_spiral_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bras_spiral/edit.html.twig', [
            'bras_spiral' => $brasSpiral,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bras_spiral_delete', methods: ['POST'])]
    public function delete(Request $request, BrasSpiral $brasSpiral, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brasSpiral->getId(), $request->request->get('_token'))) {
            $entityManager->remove($brasSpiral);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bras_spiral_index', [], Response::HTTP_SEE_OTHER);
    }
}
