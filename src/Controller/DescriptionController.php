<?php

namespace App\Controller;

use App\Entity\Description;
use App\Form\DescriptionType;
use App\Repository\DescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/description')]
class DescriptionController extends AbstractController
{
    #[Route('/', name: 'app_description_index', methods: ['GET'])]
    public function index(DescriptionRepository $descriptionRepository): Response
    {
        return $this->render('description/index.html.twig', [
            'descriptions' => $descriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_description_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DescriptionRepository $descriptionRepository): Response
    {
        $description = new Description();
        $form = $this->createForm(DescriptionType::class, $description);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $descriptionRepository->add($description, true);

            return $this->redirectToRoute('app_description_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('description/new.html.twig', [
            'description' => $description,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_description_show', methods: ['GET'])]
    public function show(Description $description): Response
    {
        return $this->render('description/show.html.twig', [
            'description' => $description,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_description_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Description $description, DescriptionRepository $descriptionRepository): Response
    {
        $form = $this->createForm(DescriptionType::class, $description);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $descriptionRepository->add($description, true);

            return $this->redirectToRoute('app_description_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('description/edit.html.twig', [
            'description' => $description,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_description_delete', methods: ['POST'])]
    public function delete(Request $request, Description $description, DescriptionRepository $descriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$description->getId(), $request->request->get('_token'))) {
            $descriptionRepository->remove($description, true);
        }

        return $this->redirectToRoute('app_description_index', [], Response::HTTP_SEE_OTHER);
    }
}
